<?php
/**
 * The site's pages. On theme activation each one is created (if missing) with its
 * template, and a "Home" page is set as the front page.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mm_page_map() {
	return array(
		'services'   => array( 'Services and Pricing', 'services-and-pricing', 'templates/services.php' ),
		'bundles'    => array( 'Variety Pack and Bundle Building', 'variety-packs', 'templates/bundles.php' ),
		'grocery'    => array( 'Grocery and CPG', 'grocery-and-cpg', 'templates/grocery.php' ),
		'calculator' => array( 'Cost Calculator', 'cost-calculator', 'templates/calculator.php' ),
		'quote'      => array( 'Get a Quote', 'get-a-quote', 'templates/quote.php' ),
	);
}

/** Find the page that uses a template. */
function mm_page_for_template( $template ) {
	$pages = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => array( 'publish', 'private', 'draft' ),
			'meta_key'       => '_wp_page_template',
			'meta_value'     => $template,
			'posts_per_page' => 1,
			'orderby'        => 'ID',
			'order'          => 'ASC',
			'fields'         => 'ids',
		)
	);
	return $pages ? (int) $pages[0] : 0;
}

/** Link to one of the site's pages by key: index, services, bundles, grocery, calculator, quote. */
function mm_url( $key ) {
	static $cache = array();
	if ( 'index' === $key ) {
		return home_url( '/' );
	}
	if ( ! isset( $cache[ $key ] ) ) {
		$map = mm_page_map();
		if ( ! isset( $map[ $key ] ) ) {
			return home_url( '/' );
		}
		$id            = mm_page_for_template( $map[ $key ][2] );
		$cache[ $key ] = $id ? get_permalink( $id ) : home_url( '/' . $map[ $key ][1] . '/' );
	}
	return $cache[ $key ];
}

function mm_urls() {
	$out = array( 'index' => mm_url( 'index' ) );
	foreach ( array_keys( mm_page_map() ) as $k ) {
		$out[ $k ] = mm_url( $k );
	}
	return $out;
}

/** Prints aria-current for the menu link of the page being viewed. */
function mm_current( $key ) {
	$map = mm_page_map();
	$on  = ( 'index' === $key ) ? is_front_page() : ( isset( $map[ $key ] ) && is_page_template( $map[ $key ][2] ) );
	if ( $on ) {
		echo ' aria-current="page"';
	}
}

function mm_create_pages() {
	foreach ( mm_page_map() as $page ) {
		if ( mm_page_for_template( $page[2] ) ) {
			continue;
		}
		$id = wp_insert_post(
			array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'post_title'  => $page[0],
				'post_name'   => $page[1],
			)
		);
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, '_wp_page_template', $page[2] );
		}
	}

	// Use a static Home page as the front page, unless one is already set.
	if ( 'page' !== get_option( 'show_on_front' ) || ! get_option( 'page_on_front' ) ) {
		$home = get_page_by_path( 'home' );
		$id   = $home ? $home->ID : wp_insert_post(
			array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'post_title'  => 'Home',
				'post_name'   => 'home',
			)
		);
		if ( $id && ! is_wp_error( $id ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $id );
		}
	}
	update_option( 'mm_pages_created', 1 );
}
add_action( 'after_switch_theme', 'mm_create_pages' );

// Backup: if the activation hook was missed, set the pages up the first time an admin opens the dashboard.
add_action(
	'admin_init',
	function () {
		if ( current_user_can( 'manage_options' ) && ! get_option( 'mm_pages_created' ) ) {
			mm_create_pages();
		}
	}
);
