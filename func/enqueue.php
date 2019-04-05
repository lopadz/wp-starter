<?php

/*
	Enqueue Theme's Scripts & Styles
*/
function wps_site_scripts() {

	// Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
	global $wp_styles;

	// ==========
	// === JS ===
	// ==========

	// Stupid IE users
	if ( preg_match( '/MSIE\s(?P<v>\d+)/i', $_SERVER['HTTP_USER_AGENT'], $browser_version ) && $browser_version['v'] <= 9 ) {
		wp_enqueue_script( 'ie-js', 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js', array(), '1.0', false );
	}

	// Custom jQuery
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '3.3.1', true );

	// Main JS
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array(), filemtime( get_template_directory() . '/assets/js/main.js' ), true );

	// ===========
	// === CSS ===
	// ===========

	// Theme
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/assets/css/main.css', array(), filemtime( get_template_directory() . '/assets/css/main.css' ), 'all' );

	// Google Fonts
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Lato:300,400,700,900', array(), '1.0', 'all' );

	// Dashicons Font
	wp_enqueue_style( 'dashicons' );

	// FontAwesome Fonts
	// wp_enqueue_style( 'fa-fonts', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0' , 'all' );

	// Default WordPress Theme Stylesheet
	// wp_enqueue_style( 'default', get_template_directory_uri() . '/style.css', array(), filemtime(get_template_directory() . '/style.css'), 'all' );

	// Comment reply script for threaded comments
	if ( is_singular() && comments_open() && ( get_option( 'thread_comments' ) === 1 ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/*
	Async Load Scripts (only external scripts)
	How-to: Add #asyncload at the end of the url
	Thanks: https://ikreativ.com/async-with-wordpress-enqueue/
*/
function wps_async_scripts( $url ) {

	if ( strpos( $url, '#asyncload' ) === false ) {
		return $url;
	} elseif ( is_admin() ) {
		return str_replace( '#asyncload', '', $url );
	} else {
		return str_replace( '#asyncload', '', $url ) . "' async='async";
	}

}


/*
	Move Gravity Forms scripts to the footer
	See: http://www.gravityhelp.com/documentation/gravity-forms/extending-gravity-forms/hooks/filters/gform_init_scripts_footer/
	And:  https://bjornjohansen.no/load-gravity-forms-js-in-footer
*/
function wrap_gform_cdata_open( $content = '' ) {
	$content = 'document.addEventListener( "DOMContentLoaded", function() { ';
	return $content;
}
function wrap_gform_cdata_close( $content = '' ) {
	$content = ' }, false );';
	return $content;
}

// Async Load Scripts
add_filter( 'clean_url', 'wps_async_scripts', 11, 1 );

// Enqueue Theme's Scripts & Styles
add_action( 'wp_enqueue_scripts', 'wps_site_scripts', 999 );

// Move Gravity Forms scripts to the footer
add_filter( 'gform_init_scripts_footer', '__return_true' );
add_filter( 'gform_cdata_open', 'wrap_gform_cdata_open' );
add_filter( 'gform_cdata_close', 'wrap_gform_cdata_close' );
