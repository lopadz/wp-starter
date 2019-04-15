<?php

// MODIFY WooCommerce elements or add your own MODIFYING functions as needed:
add_action( 'after_setup_theme', 'wps_woo_modified_parts' );

function wps_woo_modified_parts() {
	// === CHECKOUT ===
	// Add Login Form to Checkout
	add_action( 'woocommerce_before_checkout_billing_form', 'woocommerce_checkout_login_form' );

	// === SINGLE PRODUCT ===
	// Display SKU under Title
	add_action( 'woocommerce_single_product_summary', 'wps_woo_move_sku', 5 );
	// Wrap Content in Container
	add_action( 'woocommerce_before_main_content', 'wps_woo_content_wrap_start' );
	// Display Custom Breadcrumbs
	add_action( 'woocommerce_before_main_content', 'wps_woo_custom_breadcrumbs', 20, 0 );
	// Display Collections List
	add_action( 'woocommerce_single_product_summary', 'wps_woo_list_collections', 40 );
	// Wrap Content in Container
	add_action( 'woocommerce_after_main_content', 'wps_woo_content_wrap_end' );
	// Remove Additional Information
	add_filter( 'woocommerce_product_tabs', 'wps_woo_remove_additional_info_tab', 98 );
	// Remove Reviews Tab
	add_filter( 'woocommerce_product_tabs', 'wps_woo_remove_reviews_tab', 98 );
}

function wps_woo_move_sku() {
	global $product;
	if ( $product->get_sku() ) {
		echo '<p class="sku">SKU: <span>' . esc_html( $product->get_sku() ) . '</span></p>';
	}
}

function wps_woo_custom_breadcrumbs() {
	get_template_part( 'partials/collections/content-breadcrumbs' );
}

function wps_woo_list_collections() {
	get_template_part( 'partials/collections/part-list' );
}

function wps_woo_content_wrap_start() {
	echo '<div class="container">';
	echo '<div class="col-12">';
}

function wps_woo_content_wrap_end() {
	echo '</div>';
	echo '</div>';
}

function wps_woo_remove_additional_info_tab( $tabs ) {
	unset( $tabs['additional_information'] );
	return $tabs;
}

function wps_woo_remove_reviews_tab( $tabs ) {
	unset( $tabs['reviews'] );
	return $tabs;
}
