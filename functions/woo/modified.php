<?php

add_action( 'after_setup_theme', 'wps_woo_modified_parts' );

function wps_woo_modified_parts() {

	/* ========================
	 * === GLOBAL ===
	=========================*/
	// Shop page redirect
	add_action( 'template_redirect', 'wps_woo_custom_shop_page_redirect' );

	/* ========================
	 * === SINGLE PRODUCT ===
	=========================*/
	// Set Default Length
	add_filter( 'woocommerce_product_get_length', 'wps_woo_product_default_length' );
	add_filter( 'woocommerce_product_variation_get_length', 'wps_woo_product_default_length' );

	// Set Default Width
	add_filter( 'woocommerce_product_get_width', 'wps_woo_product_default_width' );
	add_filter( 'woocommerce_product_variation_get_width', 'wps_woo_product_default_width' );

	// Set Default Height
	add_filter( 'woocommerce_product_get_height', 'wps_woo_product_default_height' );
	add_filter( 'woocommerce_product_variation_get_height', 'wps_woo_product_default_height' );

	// START Wrap Content in Container
	add_action( 'woocommerce_before_main_content', 'wps_woo_content_wrap_start' );

	// Display SKU under Title
	add_action( 'woocommerce_single_product_summary', 'wps_woo_move_sku', 5 );

	// Display Custom Breadcrumbs
	add_action( 'woocommerce_before_main_content', 'wps_woo_custom_breadcrumbs', 20, 0 );

	// Move Main Content to Product Short summary
	add_action( 'woocommerce_single_product_summary', 'wps_woo_product_main_content', 20 );

	// Change name of Dropdown labels
	add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'wps_woo_filter_dropdown_args', 10 );

	// END Wrap Content in Container
	add_action( 'woocommerce_after_main_content', 'wps_woo_content_wrap_end' );

	// Rename 'Related Products' Title
	add_filter( 'gettext', 'wps_woo_rename_related_products_title' );
	add_filter( 'ngettext', 'wps_woo_rename_related_products_title' );

	/* ========================
	 * === CART ===
	=========================*/
	// Remove attributes from product title
	add_filter( 'woocommerce_product_variation_title_include_attributes', 'wps_woo_remove_attributes_in_title' );
	// Change "Return to Shop" link to homepage
	add_filter( 'woocommerce_return_to_shop_redirect', 'wps_woo_empty_cart_redirect_url' );
	// Remove ability to change quantity, only display number
	add_filter( 'woocommerce_cart_item_quantity', 'wps_woo_cart_item_quantity', 10, 3 );
	// Remove Update Cart button
	add_action( 'wp_head', 'wps_woo_hide_update_cart_button', 99 );

	/* ========================
	 * === CHECKOUT ===
	=========================*/
	// Add Login Form to Checkout
	add_action( 'woocommerce_before_checkout_billing_form', 'woocommerce_checkout_login_form' );

}

function wps_woo_move_sku() {
	global $product;
	if ( $product->get_sku() ) {
		echo '<p class="sku">SKU: <span>' . esc_html( $product->get_sku() ) . '</span></p>';
	}
}

function wps_woo_product_main_content() {
	return the_content();
}

function wps_woo_custom_breadcrumbs() {
	get_template_part( 'partials/content/breadcrumbs' );
}

function wps_woo_content_wrap_start() {
	echo '<div class="container">';
	echo '	<div class="col-12">';
}

function wps_woo_content_wrap_end() {
	echo '	</div>';
	echo '</div>';
}


function wps_woo_filter_dropdown_args( $args ) {
	$var_tax = get_taxonomy( $args['attribute'] );

	$args['show_option_none'] = apply_filters( 'the_title', 'Select ' . $var_tax->labels->singular_name );

	return $args;
}


/**
 * Snippet to set default weight and Dimension if it's not set for any product.
 * Gist Link : https://gist.github.com/xadapter/4fb8dbfc6c025630558e43488775eb7d
 */

function wps_woo_product_default_length( $length ) {

	$default_length = 18; // Provide default Length
	if ( empty( $length ) ) {
		return $default_length;
	} else {
		return $length;
	}
}

function wps_woo_product_default_width( $width ) {

	$default_width = 11.5; // Provide default Width
	if ( empty( $width ) ) {
		return $default_width;
	} else {
		return $width;
	}
}

function wps_woo_product_default_height( $height ) {

	$default_height = .2; // Provide default Height
	if ( empty( $height ) ) {
		return $default_height;
	} else {
		return $height;
	}
}

function wps_woo_remove_attributes_in_title( $boolean ) {
	if ( is_cart() ) {
		$boolean = false;
		return $boolean;
	}
}

function wps_woo_rename_related_products_title( $translated ) {
	$words      = array(
		'Related Products' => 'Other Products',
	);
	$translated = str_ireplace( array_keys( $words ), $words, $translated );
	return $translated;
}

function wps_woo_empty_cart_redirect_url() {
	return esc_url( home_url() );
}

function wps_woo_custom_shop_page_redirect() {
	if ( is_shop() ) {
		wp_safe_redirect( home_url( '/' ) );
		exit();
	}
}


function wps_woo_cart_item_quantity( $product_quantity, $cart_item_key, $cart_item ){
	if ( is_cart() ){
		$product_quantity = sprintf( '%2$s <input type="hidden" name="cart[%1$s][qty]" value="%2$s" />', $cart_item_key, $cart_item['quantity'] );
	}
	return $product_quantity;
}

function wps_woo_hide_update_cart_button() {
	if ( is_cart() ) {
		echo '
		<style type="text/css">
			button[name="update_cart"] {
				display: none !important;
			}
		</style>
		';
	}
}