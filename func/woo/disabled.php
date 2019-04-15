<?php

// DISABLE WooCommerce elements or add your own DISABLING functions as needed:
add_action( 'after_setup_theme', 'wps_woo_disabled_parts' );

function wps_woo_disabled_parts() {
	// === GLOBAL ===
	// Remove the Generator Tag
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
	// Remove Breadcrumbs
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	// Remove Sidebar
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

	// === SINGLE PRODUCT ===
	// Remove SKU
	add_filter( 'wc_product_sku_enabled', '__return_false' );
	// Remove Categories
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

	// === CHECKOUT ===
	// Remove Login form during checkout
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );

}
