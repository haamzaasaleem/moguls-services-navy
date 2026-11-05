<?php
/**
 * Prices and business settings. Stored as two options (mm_prices, mm_settings).
 * Until they are saved the first time, the defaults in the theme's data/ folder are used.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mm_default_data( $name ) {
	static $cache = array();
	if ( ! isset( $cache[ $name ] ) ) {
		$file             = get_template_directory() . '/data/' . $name . '.json';
		$cache[ $name ] = file_exists( $file ) ? json_decode( file_get_contents( $file ), true ) : array();
		if ( ! is_array( $cache[ $name ] ) ) {
			$cache[ $name ] = array();
		}
	}
	return $cache[ $name ];
}

function mm_prices() {
	$p = get_option( 'mm_prices' );
	return ( is_array( $p ) && $p ) ? $p : mm_default_data( 'prices' );
}

function mm_settings() {
	$defaults = array_merge(
		array(
			'businessName'   => 'Marketplace Moguls Services',
			'contactEmail'   => MM_DEFAULT_EMAIL,
			'quoteRecipient' => MM_DEFAULT_EMAIL,
			'fromEmail'      => MM_DEFAULT_EMAIL,
			'phone'          => '',
			'address'        => '',
			'hours'          => '',
		),
		mm_default_data( 'settings' )
	);
	$saved = get_option( 'mm_settings' );
	return is_array( $saved ) ? array_merge( $defaults, $saved ) : $defaults;
}

function mm_setting( $key ) {
	$s = mm_settings();
	return isset( $s[ $key ] ) ? (string) $s[ $key ] : '';
}

/** Data the front end scripts need. The form inbox and sender are left out on purpose. */
function mm_front_data() {
	$s = mm_settings();
	unset( $s['quoteRecipient'], $s['fromEmail'] );
	return array(
		'prices'   => mm_prices(),
		'settings' => $s,
		'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
		'urls'     => mm_urls(),
	);
}

function mm_num( $v ) {
	if ( null === $v || '' === $v || ! is_numeric( $v ) ) {
		return null;
	}
	return round( (float) $v, 4 );
}

function mm_str( $v, $max = 300 ) {
	return mb_substr( sanitize_text_field( (string) ( null === $v ? '' : $v ) ), 0, $max );
}

/** Same rules as the original api/admin.php. */
function mm_sanitize_prices( $p ) {
	$g = function ( $arr, $key, $sub = null ) {
		if ( ! is_array( $arr ) || ! array_key_exists( $key, $arr ) ) {
			return null;
		}
		$v = $arr[ $key ];
		if ( null === $sub ) {
			return $v;
		}
		return ( is_array( $v ) && array_key_exists( $sub, $v ) ) ? $v[ $sub ] : null;
	};

	$calc = (array) $g( $p, 'calculator' );
	$out  = array(
		'fnsku'            => array(
			'perItem'    => mm_num( $g( $p, 'fnsku', 'perItem' ) ),
			'twoPackAdd' => mm_num( $g( $p, 'fnsku', 'twoPackAdd' ) ),
		),
		'fulfillmentTiers' => array(),
		'bundleBase'       => array(
			'perPack' => mm_num( $g( $p, 'bundleBase', 'perPack' ) ),
			'note'    => mm_str( $g( $p, 'bundleBase', 'note' ) ),
		),
		'bundleTiers'      => array(),
		'wfsPrep'          => array(
			'perItem' => mm_num( $g( $p, 'wfsPrep', 'perItem' ) ),
			'unit'    => mm_str( $g( $p, 'wfsPrep', 'unit' ) ?: 'per item', 60 ),
			'note'    => mm_str( $g( $p, 'wfsPrep', 'note' ) ),
		),
		'palletStorage'    => array(
			'perPalletMonth' => mm_num( $g( $p, 'palletStorage', 'perPalletMonth' ) ),
			'unit'           => mm_str( $g( $p, 'palletStorage', 'unit' ) ?: 'per pallet per month', 60 ),
			'note'           => mm_str( $g( $p, 'palletStorage', 'note' ) ),
		),
		'extraServices'    => array(),
		'calculator'       => array(
			'palletUsableCubicInches' => mm_num( isset( $calc['palletUsableCubicInches'] ) ? $calc['palletUsableCubicInches'] : null ) ?: 96000,
			'palletMaxWeightLb'       => mm_num( isset( $calc['palletMaxWeightLb'] ) ? $calc['palletMaxWeightLb'] : null ) ?: 1500,
			'oversizeWeightLb'        => mm_num( isset( $calc['oversizeWeightLb'] ) ? $calc['oversizeWeightLb'] : null ) ?: 50,
			'oversizeLongestSideIn'   => mm_num( isset( $calc['oversizeLongestSideIn'] ) ? $calc['oversizeLongestSideIn'] : null ) ?: 25,
		),
	);
	foreach ( array_slice( (array) $g( $p, 'fulfillmentTiers' ), 0, 20 ) as $t ) {
		$t                         = (array) $t;
		$out['fulfillmentTiers'][] = array(
			'label'     => mm_str( isset( $t['label'] ) ? $t['label'] : '', 80 ),
			'min'       => mm_num( isset( $t['min'] ) ? $t['min'] : 0 ) ?: 0,
			'max'       => mm_num( isset( $t['max'] ) ? $t['max'] : null ),
			'firstItem' => mm_num( isset( $t['firstItem'] ) ? $t['firstItem'] : null ),
			'extraItem' => mm_num( isset( $t['extraItem'] ) ? $t['extraItem'] : null ),
		);
	}
	foreach ( array_slice( (array) $g( $p, 'bundleTiers' ), 0, 20 ) as $t ) {
		$t                    = (array) $t;
		$out['bundleTiers'][] = array(
			'label' => mm_str( isset( $t['label'] ) ? $t['label'] : '', 80 ),
			'min'   => mm_num( isset( $t['min'] ) ? $t['min'] : 0 ) ?: 0,
			'max'   => mm_num( isset( $t['max'] ) ? $t['max'] : null ),
			'price' => mm_num( isset( $t['price'] ) ? $t['price'] : null ),
		);
	}
	foreach ( array_slice( (array) $g( $p, 'extraServices' ), 0, 40 ) as $t ) {
		$t    = (array) $t;
		$name = mm_str( isset( $t['name'] ) ? $t['name'] : '', 120 );
		if ( '' === $name ) {
			continue;
		}
		$out['extraServices'][] = array(
			'name'  => $name,
			'price' => mm_num( isset( $t['price'] ) ? $t['price'] : null ),
			'unit'  => mm_str( isset( $t['unit'] ) ? $t['unit'] : '', 60 ),
		);
	}
	if ( ! $out['fulfillmentTiers'] || ! $out['bundleTiers'] ) {
		return new WP_Error( 'mm_tiers', 'Keep at least one order tier and one bundle tier.' );
	}
	return $out;
}

/** Validate business details. The form inbox may hold several addresses separated by commas. */
function mm_sanitize_settings( $s ) {
	$s   = (array) $s;
	$out = array();
	foreach ( array( 'businessName', 'contactEmail', 'quoteRecipient', 'fromEmail', 'phone', 'address', 'hours' ) as $k ) {
		$out[ $k ] = mm_str( isset( $s[ $k ] ) ? $s[ $k ] : '' );
	}
	foreach ( array( 'contactEmail', 'fromEmail' ) as $k ) {
		if ( '' !== $out[ $k ] && ! is_email( $out[ $k ] ) ) {
			return new WP_Error( 'mm_email', 'That email address does not look right: ' . $out[ $k ] );
		}
	}
	if ( '' === $out['quoteRecipient'] ) {
		return new WP_Error( 'mm_email', 'Enter the email address that should receive form submissions.' );
	}
	$list = array_filter( array_map( 'trim', explode( ',', $out['quoteRecipient'] ) ) );
	foreach ( $list as $addr ) {
		if ( ! is_email( $addr ) ) {
			return new WP_Error( 'mm_email', 'That email address does not look right: ' . $addr );
		}
	}
	$out['quoteRecipient'] = implode( ', ', $list );
	return $out;
}
