<?php
/**
 * Moguls Services theme setup.
 *
 * Where things are edited in the dashboard:
 *  - Moguls Settings: prices, business details, and the email that receives form submissions.
 *  - Appearance > Customize > Moguls Services: logos, home page text, leadership, popup.
 *  - Form Requests: every form submission is saved here as well as emailed.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MM_VERSION', '1.0.0' );
define( 'MM_DEFAULT_EMAIL', 'info@mogulsservices.com' );

require get_template_directory() . '/inc/data.php';
require get_template_directory() . '/inc/pages.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/forms.php';
require get_template_directory() . '/inc/admin.php';

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	}
);

/** URL of a file inside the theme, with a version based on its modified time. */
function mm_asset( $path ) {
	$path = ltrim( $path, '/' );
	$file = get_template_directory() . '/' . preg_replace( '/\?.*$/', '', $path );
	$url  = get_template_directory_uri() . '/' . preg_replace( '/\?.*$/', '', $path );
	return file_exists( $file ) ? add_query_arg( 'v', filemtime( $file ), $url ) : $url;
}

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'mm-fonts', 'https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&family=Barlow+Condensed:wght@600;700&family=IBM+Plex+Mono:wght@400;500&display=swap', array(), null );
		wp_enqueue_style( 'mm-style', mm_asset( 'assets/css/style.css' ), array( 'mm-fonts' ), null );
		wp_add_inline_style( 'mm-style', '.mm-page{padding:clamp(48px,7vw,96px) 0}.mm-page .entry{max-width:780px}.mm-page .entry img{max-width:100%;height:auto}' );

		wp_enqueue_script( 'mm-site', mm_asset( 'assets/js/site.js' ), array(), null, true );
		wp_add_inline_script( 'mm-site', 'window.MM_DATA = ' . wp_json_encode( mm_front_data() ) . ';', 'before' );
		wp_enqueue_script( 'mm-3d', mm_asset( 'assets/js/three-d.js' ), array( 'mm-site' ), null, true );
		if ( is_page_template( 'templates/calculator.php' ) ) {
			wp_enqueue_script( 'mm-calc', mm_asset( 'assets/js/calculator.js' ), array( 'mm-site', 'mm-3d' ), null, true );
		}
	}
);

/** Small inline script that skips the loading screen after the first page of a visit. */
add_action(
	'wp_head',
	function () {
		echo '<script>try{if(sessionStorage.getItem("mm_seen"))document.documentElement.classList.add("no-loader")}catch(e){}</script>' . "\n";
		echo '<noscript><style>.loader{display:none}</style></noscript>' . "\n";
		if ( ! has_site_icon() ) {
			echo '<link rel="icon" href="' . esc_url( mm_asset( 'assets/img/favicon.png' ) ) . '">' . "\n";
		}
		$desc = mm_meta( 'description' );
		if ( $desc ) {
			echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
		}
	},
	1
);

/** Templates set their own title and description, matching the original site. */
function mm_set_meta( $title, $description ) {
	$GLOBALS['mm_meta'] = array(
		'title'       => $title,
		'description' => $description,
	);
}
function mm_meta( $key ) {
	return isset( $GLOBALS['mm_meta'][ $key ] ) ? $GLOBALS['mm_meta'][ $key ] : '';
}
add_filter(
	'pre_get_document_title',
	function ( $title ) {
		$t = mm_meta( 'title' );
		return $t ? $t : $title;
	}
);
