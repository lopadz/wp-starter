<?php

// ENABLE and/or start WooCommerce elements
add_action( 'after_setup_theme', 'wps_woo_start' );

function wps_woo_start() {
	// Declare WooCommerce Compability with theme
	add_theme_support( 'woocommerce' );
	// Enable WooCommerce features
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
