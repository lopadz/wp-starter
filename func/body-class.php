<?php

// Classes added to body_class in header.php
function wps_body_classes( $classes ) {

	if ( is_page( 'slug' ) ) :
		$classes[] = 'page-slug';
		// $classes[] = 'class-name-two';

		// elseif ( is_page( 'slug' ) ) :
		// 	$classes[] = 'page-slug';

		// elseif ( is_page_template( 'templates/filename.php' ) ) :
		// 	$classes[] = 'template-filename';

	endif;

	return $classes;
}
add_filter( 'body_class', 'wps_body_classes' );

// Add Browser Specific Class
function wps_browser_body_class( $classes ) {

	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if ( $is_lynx ) {
		$classes[] = 'lynx';
	} elseif ( $is_gecko ) {
		$classes[] = 'gecko';
	} elseif ( $is_opera ) {
		$classes[] = 'opera';
	} elseif ( $is_NS4 ) {
		$classes[] = 'ns4';
	} elseif ( $is_safari ) {
		$classes[] = 'safari';
	} elseif ( $is_chrome ) {
		$classes[] = 'chrome';
	} elseif ( $is_IE ) {
		$classes[] = 'ie';
		if ( preg_match( '/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version ) ) {
			$classes[] = 'ie' . $browser_version[1];
		}
	} else {
		$classes[] = 'unknown';
	}

	if ( $is_iphone ) {
		$classes[] = 'iphone';
	}

	if ( stristr( $_SERVER['HTTP_USER_AGENT'], 'mac' ) ) {
		$classes[] = 'osx';
	} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'], 'linux' ) ) {
			$classes[] = 'linux';
	} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'], 'windows' ) ) {
			$classes[] = 'windows';
	}
	return $classes;
}
add_filter( 'body_class', 'wps_browser_body_class' );

/**
*   Child page conditional
*   @ Accept's page ID, page slug or page title as parameters
*/

function is_child_page( $parent = '' ) {
	global $post;

	$parent_obj   = get_page( $post->post_parent, ARRAY_A );
	$parent       = (string) $parent;
	$parent_array = (array) $parent;

	if ( in_array( (string) $parent_obj['ID'], $parent_array ) ) {
		return true;
	} elseif ( in_array( (string) $parent_obj['post_title'], $parent_array ) ) {
		return true;
	} elseif ( in_array( (string) $parent_obj['post_name'], $parent_array ) ) {
		return true;
	} else {
		return false;
	}
}
