<?php

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

	// Remove Description Tab
	add_filter( 'woocommerce_product_tabs', 'wps_woo_remove_description_tab', 98 );

	// Remove Additional Information Tab
	add_filter( 'woocommerce_product_tabs', 'wps_woo_remove_additional_info_tab', 98 );

	// Remove Reviews Tab
	add_filter( 'woocommerce_product_tabs', 'wps_woo_remove_reviews_tab', 98 );

	// === CHECKOUT ===
	// Remove Login form during checkout
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );

}


function wps_woo_remove_description_tab( $tabs ) {
	unset( $tabs['description'] );
	return $tabs;
}

function wps_woo_remove_additional_info_tab( $tabs ) {
	unset( $tabs['additional_information'] );
	return $tabs;
}

function wps_woo_remove_reviews_tab( $tabs ) {
	unset( $tabs['reviews'] );
	return $tabs;
}
