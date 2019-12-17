<?php

// Calling your own login css so you can style it
function wps_login_css() {
	wp_enqueue_style( 'wps_login_css', get_template_directory_uri() . '/assets/css/login.css', array(), filemtime( get_template_directory() . '/assets/css/login.css' ), 'all' );
}

// Changing the logo link from wordpress.org to your site
function wps_login_url() {
	return home_url();
}

// Changing the alt text on the logo to show your site name
function wps_login_title() {
	return get_option( 'blogname' );
}

// Calling it only on the login page
add_action( 'login_enqueue_scripts', 'wps_login_css', 10 );
add_filter( 'login_headerurl', 'wps_login_url' );
add_filter( 'login_headertext', 'wps_login_title' );
