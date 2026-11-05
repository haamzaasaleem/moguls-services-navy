<?php
/**
 * Form handling. The quote, bundle and calculator forms post here through admin-ajax.
 * Each submission is saved under Form Requests in the dashboard and emailed to the
 * address in Moguls Settings > "Send form submissions to".
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mm_form_defs() {
	return array(
		'quote'      => array(
			'label'   => 'Quote request',
			'subject' => 'New quote request',
			'fields'  => array(
				'name'          => 'Name',
				'email'         => 'Email',
				'phone'         => 'Phone',
				'company'       => 'Company',
				'marketplaces'  => 'Marketplaces',
				'monthly_units' => 'Monthly units',
				'daily_orders'  => 'Daily orders',
				'services'      => 'Services needed',
				'message'       => 'Message',
			),
		),
		'bundle'     => array(
			'label'   => 'Variety pack request',
			'subject' => 'New variety pack request',
			'fields'  => array(
				'name'               => 'Name',
				'email'              => 'Email',
				'category'           => 'Product category',
				'items_per_pack'     => 'Items per pack',
				'different_products' => 'Different products per pack',
				'bundles_per_month'  => 'Bundles per month',
				'destination'        => 'Destination',
				'message'            => 'Notes',
			),
		),
		'calculator' => array(
			'label'   => 'Calculator quote',
			'subject' => 'Exact quote request from the calculator',
			'fields'  => array(
				'name'           => 'Name',
				'email'          => 'Email',
				'weight'         => 'Weight',
				'size'           => 'Size',
				'items_per_pack' => 'Items per pack',
				'daily_orders'   => 'Daily orders',
				'monthly_units'  => 'Monthly units',
				'estimate'       => 'Estimate shown',
			),
		),
	);
}

function mm_clean( $v ) {
	if ( is_array( $v ) ) {
		$v = implode( ', ', array_map( 'mm_clean', $v ) );
	}
	return mb_substr( sanitize_textarea_field( (string) $v ), 0, 3000 );
}

function mm_handle_form() {
	$post = wp_unslash( $_POST ); // phpcs:ignore WordPress.Security.NonceVerification -- public form, protected by honeypot and rate limit.

	// Bots fill the hidden "website" field; pretend it worked.
	if ( ! empty( $post['website'] ) ) {
		wp_send_json( array( 'ok' => true ) );
	}

	$defs = mm_form_defs();
	$type = isset( $post['form_type'] ) ? sanitize_key( $post['form_type'] ) : '';
	if ( ! isset( $defs[ $type ] ) ) {
		wp_send_json( array( 'ok' => false, 'error' => 'Unknown form.' ), 400 );
	}

	// At most 8 submissions per visitor every 10 minutes.
	$ip   = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key  = 'mm_rl_' . md5( $ip );
	$seen = (int) get_transient( $key );
	if ( $seen >= 8 ) {
		wp_send_json( array( 'ok' => false, 'error' => 'Too many requests. Please wait a few minutes or email us directly.' ), 429 );
	}
	set_transient( $key, $seen + 1, 10 * MINUTE_IN_SECONDS );

	$email = isset( $post['email'] ) ? sanitize_email( $post['email'] ) : '';
	if ( ! is_email( $email ) ) {
		wp_send_json( array( 'ok' => false, 'error' => 'Please enter a valid email address.' ), 422 );
	}
	$name = isset( $post['name'] ) ? preg_replace( '/[\r\n]+/', ' ', mm_clean( $post['name'] ) ) : '';
	if ( 'quote' === $type && '' === $name ) {
		wp_send_json( array( 'ok' => false, 'error' => 'Please enter your name.' ), 422 );
	}

	$lines = array();
	foreach ( $defs[ $type ]['fields'] as $field => $label ) {
		$val     = isset( $post[ $field ] ) ? mm_clean( $post[ $field ] ) : '';
		$lines[] = $label . ': ' . ( '' === $val ? '(not given)' : $val );
	}
	$lines[] = '';
	$lines[] = 'Sent ' . wp_date( 'M j, Y g:i A' ) . ' from ' . ( isset( $_SERVER['HTTP_REFERER'] ) ? esc_url_raw( wp_unslash( $_SERVER['HTTP_REFERER'] ) ) : home_url( '/' ) );
	$body    = implode( "\n", $lines );
	$subject = $defs[ $type ]['subject'] . ( '' !== $name ? ' from ' . $name : '' );

	// Keep a copy in the dashboard, so nothing is lost if email delivery fails.
	$id = wp_insert_post(
		array(
			'post_type'    => 'mm_request',
			'post_status'  => 'private',
			'post_title'   => $subject,
			'post_content' => $body,
		)
	);
	if ( $id && ! is_wp_error( $id ) ) {
		update_post_meta( $id, '_mm_email', $email );
		update_post_meta( $id, '_mm_type', $type );
	}

	$to = mm_setting( 'quoteRecipient' );
	if ( '' === trim( $to ) ) {
		$to = MM_DEFAULT_EMAIL;
	}
	$from    = mm_setting( 'fromEmail' );
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . ( $name ? $name . ' <' . $email . '>' : $email ) );
	if ( is_email( $from ) ) {
		$headers[] = 'From: ' . wp_specialchars_decode( mm_setting( 'businessName' ), ENT_QUOTES ) . ' <' . $from . '>';
	}
	$sent = wp_mail( array_map( 'trim', explode( ',', $to ) ), $subject, $body, $headers );
	if ( $id && ! is_wp_error( $id ) ) {
		update_post_meta( $id, '_mm_sent', $sent ? 1 : 0 );
	}

	if ( ! $sent && ! ( $id && ! is_wp_error( $id ) ) ) {
		wp_send_json( array( 'ok' => false, 'error' => 'Our mail server did not accept the message. Please email us directly.' ), 500 );
	}
	wp_send_json( array( 'ok' => true ) );
}
add_action( 'wp_ajax_mm_send', 'mm_handle_form' );
add_action( 'wp_ajax_nopriv_mm_send', 'mm_handle_form' );

/** Form Requests in the dashboard. Read only: they come from the website forms. */
add_action(
	'init',
	function () {
		register_post_type(
			'mm_request',
			array(
				'labels'          => array(
					'name'          => 'Form Requests',
					'singular_name' => 'Form Request',
					'edit_item'     => 'Form Request',
					'search_items'  => 'Search requests',
					'not_found'     => 'No form requests yet.',
				),
				'public'          => false,
				'show_ui'         => true,
				'show_in_menu'    => true,
				'menu_position'   => 26,
				'menu_icon'       => 'dashicons-email-alt',
				'supports'        => array( 'title', 'editor' ),
				'capability_type' => 'post',
				'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
				'map_meta_cap'    => true,
			)
		);
	}
);

add_filter(
	'manage_mm_request_posts_columns',
	function ( $cols ) {
		return array(
			'cb'       => $cols['cb'],
			'title'    => 'Request',
			'mm_email' => 'Customer email',
			'mm_type'  => 'Form',
			'mm_sent'  => 'Emailed',
			'date'     => 'Date',
		);
	}
);
add_action(
	'manage_mm_request_posts_custom_column',
	function ( $col, $id ) {
		if ( 'mm_email' === $col ) {
			$e = get_post_meta( $id, '_mm_email', true );
			echo '<a href="mailto:' . esc_attr( $e ) . '">' . esc_html( $e ) . '</a>';
		} elseif ( 'mm_type' === $col ) {
			$defs = mm_form_defs();
			$t    = get_post_meta( $id, '_mm_type', true );
			echo esc_html( isset( $defs[ $t ] ) ? $defs[ $t ]['label'] : $t );
		} elseif ( 'mm_sent' === $col ) {
			echo get_post_meta( $id, '_mm_sent', true ) ? 'Yes' : '<strong style="color:#b3261e">Not sent</strong>';
		}
	},
	10,
	2
);
