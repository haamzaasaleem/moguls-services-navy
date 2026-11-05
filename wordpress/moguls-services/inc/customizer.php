<?php
/**
 * Appearance > Customize > Moguls Services: logos, home page text, leadership and the popup.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mm_mod_defaults() {
	$img = get_template_directory_uri() . '/assets/img/';
	return array(
		'logo_header'    => $img . 'logo.png',
		'logo_footer'    => $img . 'logo-light.png',
		'hero_tag'       => '3PL warehouse in Bolingbrook, Illinois',
		'hero_title'     => 'Delivered to us today.',
		'hero_highlight' => 'Shipped within 24 hours.',
		'hero_lead'      => 'We prep and ship for Amazon FBA, Walmart WFS, FBM and 2 step dropshipping. Your items go out within 24 hours of landing at our dock, and your first month of storage is free.',
		'lead_heading'   => 'The people behind your fulfillment',
		'leader1_name'   => 'Syed Alam',
		'leader1_title'  => 'CEO',
		'leader1_photo'  => $img . 'ceo-syed.jpg',
		'leader2_name'   => 'Usama Farooq',
		'leader2_title'  => 'Chief of Digital Operations',
		'leader2_photo'  => $img . 'cdo-usama.jpg',
		'msg_tag'        => 'A message from our CEO',
		'msg_heading'    => 'Your brand is our brand.',
		'msg_body'       => "When you hand us your inventory, you are handing us your reputation. Every label, every count and every box that leaves our Bolingbrook warehouse carries your name, so we treat it that way.\n\nWe built Marketplace Moguls around three promises: accurate fulfillment, discounted rates and total transparency. Our prices are posted on this site, your goods ship within 24 hours of reaching our dock, and if something is off, you hear it from us first.\n\nWhether you are sending your first pallet or your fiftieth, we want to be the warehouse that makes your work easier. Send us your SKU list and we will show you what working together looks like.",
		'msg_sign'       => 'Syed Alam, CEO',
		'footer_blurb'   => 'Prep, storage and fulfillment for Amazon, Walmart and direct to consumer sellers. Items ship within 24 hours of arriving at our warehouse.',
		'popup_on'       => true,
	);
}

function mm_mod( $key ) {
	$d = mm_mod_defaults();
	$v = get_theme_mod( 'mm_' . $key, isset( $d[ $key ] ) ? $d[ $key ] : '' );
	// An emptied image or text falls back to the default instead of leaving a gap.
	if ( '' === $v && isset( $d[ $key ] ) && ! is_bool( $d[ $key ] ) ) {
		return $d[ $key ];
	}
	return $v;
}

add_action(
	'customize_register',
	function ( $wp ) {
		$d = mm_mod_defaults();
		$wp->add_panel(
			'mm_panel',
			array(
				'title'       => 'Moguls Services',
				'priority'    => 30,
				'description' => 'Prices, phone, address and the form email are under Moguls Settings in the dashboard menu.',
			)
		);

		$text = function ( $section, $key, $label, $type = 'text', $desc = '' ) use ( $wp, $d ) {
			$wp->add_setting(
				'mm_' . $key,
				array(
					'default'           => $d[ $key ],
					'sanitize_callback' => 'textarea' === $type ? 'sanitize_textarea_field' : 'sanitize_text_field',
					'transport'         => 'refresh',
				)
			);
			$wp->add_control(
				'mm_' . $key,
				array(
					'section'     => $section,
					'label'       => $label,
					'type'        => $type,
					'description' => $desc,
				)
			);
		};
		$image = function ( $section, $key, $label, $desc = '' ) use ( $wp, $d ) {
			$wp->add_setting(
				'mm_' . $key,
				array(
					'default'           => $d[ $key ],
					'sanitize_callback' => 'esc_url_raw',
				)
			);
			$wp->add_control(
				new WP_Customize_Image_Control(
					$wp,
					'mm_' . $key,
					array(
						'section'     => $section,
						'label'       => $label,
						'description' => $desc,
					)
				)
			);
		};

		$wp->add_section( 'mm_logos', array( 'title' => 'Logos', 'panel' => 'mm_panel' ) );
		$image( 'mm_logos', 'logo_header', 'Header logo', 'Shown on a light background.' );
		$image( 'mm_logos', 'logo_footer', 'Footer logo', 'Shown on the navy footer, so use a light version.' );
		$text( 'mm_logos', 'footer_blurb', 'Footer text', 'textarea' );

		$wp->add_section( 'mm_hero', array( 'title' => 'Home page top', 'panel' => 'mm_panel' ) );
		$text( 'mm_hero', 'hero_tag', 'Small label above the headline' );
		$text( 'mm_hero', 'hero_title', 'Headline' );
		$text( 'mm_hero', 'hero_highlight', 'Headline, highlighted part' );
		$text( 'mm_hero', 'hero_lead', 'Text under the headline', 'textarea' );

		$wp->add_section( 'mm_leaders', array( 'title' => 'Leadership', 'panel' => 'mm_panel' ) );
		$text( 'mm_leaders', 'lead_heading', 'Section heading' );
		$text( 'mm_leaders', 'leader1_name', 'First person: name' );
		$text( 'mm_leaders', 'leader1_title', 'First person: job title' );
		$image( 'mm_leaders', 'leader1_photo', 'First person: photo', 'Portrait, about 4 wide by 5 tall.' );
		$text( 'mm_leaders', 'leader2_name', 'Second person: name' );
		$text( 'mm_leaders', 'leader2_title', 'Second person: job title' );
		$image( 'mm_leaders', 'leader2_photo', 'Second person: photo', 'Portrait, about 4 wide by 5 tall.' );
		$text( 'mm_leaders', 'msg_tag', 'Message: small label' );
		$text( 'mm_leaders', 'msg_heading', 'Message: heading' );
		$text( 'mm_leaders', 'msg_body', 'Message text', 'textarea', 'Leave a blank line between paragraphs.' );
		$text( 'mm_leaders', 'msg_sign', 'Message: signature' );

		$wp->add_section( 'mm_popup', array( 'title' => 'Home page popup', 'panel' => 'mm_panel' ) );
		$wp->add_setting(
			'mm_popup_on',
			array(
				'default'           => true,
				'sanitize_callback' => 'wp_validate_boolean',
			)
		);
		$wp->add_control(
			'mm_popup_on',
			array(
				'section' => 'mm_popup',
				'label'   => 'Show the quick facts popup on the home page',
				'type'    => 'checkbox',
			)
		);
	}
);
