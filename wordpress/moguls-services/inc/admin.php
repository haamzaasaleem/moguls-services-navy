<?php
/**
 * Dashboard > Moguls Settings: prices, business details and the form email.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'admin_menu',
	function () {
		$hook = add_menu_page( 'Moguls Settings', 'Moguls Settings', 'manage_options', 'moguls-settings', 'mm_admin_page', 'dashicons-store', 25 );
		add_action(
			'admin_enqueue_scripts',
			function ( $h ) use ( $hook ) {
				if ( $h !== $hook ) {
					return;
				}
				wp_enqueue_style( 'mm-admin', mm_asset( 'assets/admin/admin.css' ), array(), null );
				wp_enqueue_script( 'mm-admin', mm_asset( 'assets/admin/admin.js' ), array(), null, true );
				wp_add_inline_script(
					'mm-admin',
					'window.MM_ADMIN = ' . wp_json_encode(
						array(
							'ajaxUrl' => admin_url( 'admin-ajax.php' ),
							'nonce'   => wp_create_nonce( 'mm_save' ),
							'data'    => array(
								'prices'   => mm_prices(),
								'settings' => mm_settings(),
							),
						)
					) . ';',
					'before'
				);
			}
		);
	}
);

function mm_admin_page() {
	?>
	<div class="wrap mm-admin">
		<h1>Moguls Settings</h1>
		<p>Prices, contact details and the form email. Changes show on every page and in the cost calculator as soon as you save.</p>
		<noscript><p><strong>This page needs JavaScript.</strong></p></noscript>
		<form id="editor"></form>
	</div>
	<?php
}

add_action(
	'wp_ajax_mm_save_settings',
	function () {
		check_ajax_referer( 'mm_save', 'nonce' );
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json( array( 'ok' => false, 'error' => 'You do not have permission to change these settings.' ), 403 );
		}
		$body = json_decode( wp_unslash( isset( $_POST['payload'] ) ? $_POST['payload'] : '' ), true ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- each field is sanitized below.
		if ( ! is_array( $body ) || ! isset( $body['prices'], $body['settings'] ) ) {
			wp_send_json( array( 'ok' => false, 'error' => 'Missing data.' ), 400 );
		}
		$prices = mm_sanitize_prices( $body['prices'] );
		if ( is_wp_error( $prices ) ) {
			wp_send_json( array( 'ok' => false, 'error' => $prices->get_error_message() ), 422 );
		}
		$settings = mm_sanitize_settings( $body['settings'] );
		if ( is_wp_error( $settings ) ) {
			wp_send_json( array( 'ok' => false, 'error' => $settings->get_error_message() ), 422 );
		}
		update_option( 'mm_prices', $prices, true );
		update_option( 'mm_settings', $settings, true );
		wp_send_json( array( 'ok' => true, 'data' => array( 'prices' => $prices, 'settings' => $settings ) ) );
	}
);

/** Link to the settings from the Themes screen. */
add_action(
	'admin_notices',
	function () {
		$screen = get_current_screen();
		if ( ! $screen || 'themes' !== $screen->id || ! current_user_can( 'manage_options' ) ) {
			return;
		}
		echo '<div class="notice notice-info"><p>Moguls Services: edit prices, contact details and the form email under <a href="' . esc_url( admin_url( 'admin.php?page=moguls-settings' ) ) . '">Moguls Settings</a>. Logos, home page text and leadership are in <a href="' . esc_url( admin_url( 'customize.php' ) ) . '">Customize</a>.</p></div>';
	}
);
