<?php

/**
	Template Name: Layout Builder 1
	Template Post Type: post, page
*/

wps_get_header();

$current_post_id = get_the_ID();

// Get the Top Banner Module
wps_acf_get_module( 'template-lb1-top_banner', 'top-banner', $current_post_id );

// Get ACF layouts (or Modules)
$args = [
	'flexible_content' => 'template-lb1',
	'field_prefix'     => 'lb1',
	'layouts'          => [ 'cards', 'carousel', 'columns', 'hero', 'html', 'tabs' ],
];
wps_acf_get_modules( $args );

wps_get_footer();
