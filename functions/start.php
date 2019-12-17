<?php

// Fire all our initial functions at the start
add_action( 'after_setup_theme', 'wps_start' );

function wps_start() {

	// =========================
	// FUNCTIONS & THEME SUPPORT
	// =========================

	// Add WP Thumbnail Support
	add_theme_support( 'post-thumbnails' );

	// Default thumbnail size
	set_post_thumbnail_size( 125, 125, true );

	// Add RSS Support
	add_theme_support( 'automatic-feed-links' );

	// Add Support for WP Controlled Title Tag
	add_theme_support( 'title-tag' );

	// Add HTML5 Support
	add_theme_support(
		'html5',
		array(
			'comment-list',
			'comment-form',
			'search-form',
		)
	);

	// Adding post format support
	add_theme_support(
		'post-formats',
		array(
			'aside', // title less blurb
			'gallery', // gallery of images
			'link', // quick link to other site
			'image', // an image
			'quote', // a quick quote
			'status', // a Facebook like status update
			'video', // video
			'audio', // audio
			'chat', // chat transcript
		)
	);

	// Adding sidebars to WordPress
	add_action( 'widgets_init', 'wps_register_sidebars' );

	// Set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
	$GLOBALS['content_width'] = apply_filters( 'wps_theme_support', 1500 );

	// Limit uploading images too darn big!
	// Enable this after site has launched.
	// add_filter( 'wp_handle_upload_prefilter', 'wps_max_image_size' );

	// =======================
	// WP HEAD CLEANUP & FIXES
	// =======================

	// Remove category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Remove post and comment feeds
	remove_action( 'wp_head', 'feed_links', 2 );

	// Remove EditURI link
	remove_action( 'wp_head', 'rsd_link' );

	// Remove Windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Remove index link
	remove_action( 'wp_head', 'index_rel_link' );

	// Remove WP version
	remove_action( 'wp_head', 'wp_generator' );

	// Disable JSON REST API
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
	remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );

	// Remove previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

	// Remove start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

	// Remove links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	// All actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// Filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'wps_disable_emoji_tinymce' );

	// Clean up comment styles in the head
	add_action( 'wp_head', 'wps_remove_recent_comments_style', 1 );

	// Remove pesky injected css for recent comments widget
	add_filter( 'wp_head', 'wps_remove_wp_widget_recent_comments_style', 1 );

	// Clean up gallery output in wp
	add_filter( 'gallery_style', 'wps_gallery_style' );

	// Cleaning up excerpt
	add_filter( 'excerpt_more', 'wps_excerpt_more' );

	// Stop WordPress from using the sticky class on sticky blog posts
	add_filter( 'post_class', 'wps_remove_sticky_class' );

	// Enable SVG files to be uploaded to Media
	add_filter( 'upload_mimes', 'cc_mime_types' );

	// Deactivate Gutenberg without need for a plugin!
	add_filter( 'use_block_editor_for_post', '__return_false' );

	// Remove JetPack injected ads from WC 3.6
	add_filter( 'jetpack_show_promotions', '__return_false' );

	// Remove WC injected ads from WC 3.6:
	add_filter( 'woocommerce_allow_marketplace_suggestions', '__return_false' );

}

// Remove injected CSS from recent comments widget
function wps_remove_recent_comments_style() {
	global $wp_widget_factory;
	if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
}

// Remove injected CSS for recent comments widget
function wps_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

function wps_disable_emoji_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// Remove injected CSS from gallery
function wps_gallery_style( $css ) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

// This removes the annoying […] to a Read More link
function wps_excerpt_more( $more ) {
	global $post;
	// edit here if you like
	return '<a class="excerpt-read-more" href="' . get_permalink( $post->ID ) . '" title="' . __( 'Read', 'wps' ) . get_the_title( $post->ID ) . '">' . __( '... Read more &raquo;', 'wps' ) . '</a>';
}

// Stop WordPress from using the sticky class (which conflicts with Foundation), and style WordPress sticky posts using the .wp-sticky class instead
function wps_remove_sticky_class( $classes ) {
	if ( in_array( 'sticky', $classes ) ) {
		$classes   = array_diff( $classes, array( 'sticky' ) );
		$classes[] = 'wp-sticky';
	}

	return $classes;
}

// Enable SVG files to be uploaded to Media
function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

// Credit: https://wordpress.stackexchange.com/questions/130203/limit-image-resolution-on-upload
function wps_max_image_size( $file ) {
	$image = getimagesize( $file['tmp_name'] );

	$minimum = array(
		'width'  => '5',
		'height' => '5',
	);

	$maximum = array(
		'width'  => '2000',
		'height' => '2000',
	);

	$image_width  = $image[0];
	$image_height = $image[1];

	$too_small = "Image dimensions are too small. Minimum size is {$minimum['width']} by {$minimum['height']} pixels. Uploaded image is $image_width by $image_height pixels.";
	$too_large = "Image dimensions are too large. Maximum size is {$maximum['width']} by {$maximum['height']} pixels. Uploaded image is $image_width by $image_height pixels.";

	if ( $image_width < $minimum['width'] || $image_height < $minimum['height'] ) {
		// add in the field 'error' of the $file array the message
		$file['error'] = $too_small;
		return $file;
	} elseif ( $image_width > $maximum['width'] || $image_height > $maximum['height'] ) {
		//add in the field 'error' of the $file array the message
		$file['error'] = $too_large;
		return $file;
	} else {
		return $file;
	}
}
