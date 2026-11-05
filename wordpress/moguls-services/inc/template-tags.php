<?php
/** Small output helpers used by the templates. */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Echo an escaped setting (business name, phone, address...). */
function mm_s( $key ) {
	echo esc_html( mm_setting( $key ) );
}

function mm_tel_href() {
	return 'tel:' . preg_replace( '/[^\d+]/', '', mm_setting( 'phone' ) );
}

function mm_mailto_href() {
	return 'mailto:' . mm_setting( 'contactEmail' );
}

/** Echo an escaped Customizer value. */
function mm_t( $key ) {
	echo esc_html( mm_mod( $key ) );
}

/** Echo text with blank lines turned into paragraphs. */
function mm_paragraphs( $text ) {
	foreach ( preg_split( '/\n\s*\n/', trim( (string) $text ) ) as $p ) {
		if ( '' !== trim( $p ) ) {
			echo '<p>' . nl2br( esc_html( trim( $p ) ) ) . '</p>' . "\n";
		}
	}
}
