<?php


// ================================================================
function wps_woo_support() {
	// Declare WooCommerce Compability with theme
	add_theme_support( 'woocommerce' );

	// Enable WooCommerce features
	// add_theme_support( 'wc-product-gallery-zoom' );
	// add_theme_support( 'wc-product-gallery-lightbox' );
	// add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'wps_woo_support' );


// ================================================================
// Remove default WooCommerce styles one by one
function wps_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );     // Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );      // Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] ); // Remove the smallscreen optimization
	return $enqueue_styles;
}
add_filter( 'woocommerce_enqueue_styles', 'wps_dequeue_styles' );


// ================================================================
/**
 * Place a cart icon with number of items and total cost in the menu bar.
 *
 * Source: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */
function wps_menucart( $menu, $args ) {

	// Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
	if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'main' !== $args->theme_location )
		return $menu;

	ob_start();

	global $woocommerce;
	$viewing_cart        = __( 'View your shopping cart', 'wps' );
	$start_shopping      = __( 'Start shopping', 'wps' );
	$cart_url            = $woocommerce->cart->get_cart_url();
	$shop_page_url       = get_permalink( woocommerce_get_page_id( 'shop' ) );
	$cart_contents_count = $woocommerce->cart->cart_contents_count;
	$cart_contents       = sprintf( _n( '%d item', '%d items', $cart_contents_count, 'wps' ), $cart_contents_count );
	$cart_total          = $woocommerce->cart->get_cart_total();

	// Uncomment the line below to hide nav menu cart item when there are no items in the cart
	if ( $cart_contents_count > 0 ) {
		if ( 0 === $cart_contents_count ) {
			$menu_item = '<li class="wc-cart"><a class="contents" href="' . $shop_page_url . '" title="' . $start_shopping . '">Shop Here</a></li>';
		} else {
			$menu_item = '<li class="wc-cart"><a class="contents" href="' . $cart_url . '" title="' . $viewing_cart . '"><span class="dashicons dashicons-cart"></span> ' . $cart_contents . ' - ' . $cart_total . '</a></li>';
		}
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
	}

	echo $menu_item;

	$social = ob_get_clean();

	return $menu . $social;

}
add_filter( 'wp_nav_menu_items', 'wps_menucart', 10, 2 );


// ================================================================
// Remove the generator tag
// remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );


// ================================================================
// Remove Breadcrumbs from Shop & Product Categories pages
add_action( 'woocommerce_before_main_content', 'wps_remove_wc_breadcrumbs' );
function wps_remove_wc_breadcrumbs() {
	if ( is_shop() ) {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}
}


// ================================================================
// Remove Title from Main Shop page
// add_action( 'wp', 'wps_hide_shop_title' );
// function wps_hide_shop_title() {
// 	if ( is_shop() ) {
// 		add_filter( 'woocommerce_show_page_title', 'hide_title' );
// 		function hide_title() {
// 			return false;
// 		}
// 	}
// }


// ================================================================
// Remove sorting dropdown and result count
function wps_remove_loop_from_shop() {
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
}
add_action( 'woocommerce_before_shop_loop', 'wps_remove_loop_from_shop' );


// ================================================================
// Change content wrapper markup in Shop & Product Categories pages
function woocommerce_output_content_wrapper() {
	if ( is_shop() || is_product_category() ) {
		echo '<section class="shop">';
		echo '<div class="container">';
		echo '<aside id="secondary" class="shop-sidebar col sm-12 md-4 lg-3">';
		echo '<a href="javascript:void(0);" class="button">Product Categories</a>';

		echo '<h2 class="f-s-7">Product Categories</h2>';
		dynamic_sidebar( 'wc_sidebar1' );

		echo '</aside>';
		echo '<main id="primary" class="shop-main col sm-12 md-8 lg-9">';
	} else {
		echo '<section class="shop single">';
		echo '<div class="container">';
		echo '<main id="primary" class="shop-main col-12">';
	}
}
add_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );

function woocommerce_output_content_wrapper_end() {
	if ( is_shop() || is_product_category() ) {
		echo '</main>';
		echo '</div>';
		echo '</section>';
	}
}
add_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );


// ================================================================
// Remove the product rating display on product loops
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// Custom breadcrumbs to match Foundation's markup
// function wps_wc_breadcrumbs() {
// 	return array(
// 		'delimiter'   => '',
// 		'wrap_before' => '<nav aria-label="You are here:" role="navigation"> <ul class="breadcrumbs">',
// 		'wrap_after'  => '</ul></nav>',
// 		'before'      => '<li>',
// 		'after'       => '</li>',
// 	);
// }
// add_filter( 'woocommerce_breadcrumb_defaults', 'wps_wc_breadcrumbs', 20 );


// ================================================================
// Removes the Sidebar function to load it somewhere else
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


// ================================================================
// Limit number of products on shop page
function new_loop_shop_per_page( $cols ) {
	// $cols contains the current number of products per page based on the value stored on Options -> Reading
	// Return the number of products you wanna show per page.
	$cols = 9;
	return $cols;
}
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );


// ================================================================
// Add SKU to below the Title
function wps_show_sku() {
	global $product;
	echo '<p class="sku">SKU: <span>' . $product->get_sku() . '</span></p>';
}
add_action( 'woocommerce_single_product_summary', 'osd_show_sku', 5 );


// ================================================================
// Add custom tabs to single product page
/*
function wps_custom_product_tabs( $tabs ) {

	// Check if there's data in the ACF fields to display the tab
	if ( get_field( 'product-custom_tab-specs' ) ) {
		// Display the custom tab 1
		$tabs['specs'] = array(
			'title'    => __( 'Specs', 'woocommerce' ),
			'priority' => 10,
			'callback' => 'wps_custom_tab_specs',
		);
	}

	if ( get_field( 'product-custom_tab-allergens' ) ) {
		// Display the custom tab 2
		$tabs['allergens'] = array(
			'title'    => __( 'Allergens', 'woocommerce' ),
			'priority' => 15,
			'callback' => 'wps_custom_tab_allergens',
		);
	}

	if ( get_field( 'product-custom_tab-shipping_info' ) ) {
		// Display the custom tab 3
		$tabs['shipping_info'] = array(
			'title'    => __( 'Shipping', 'woocommerce' ),
			'priority' => 20,
			'callback' => 'wps_custom_tab_shipping_info',
		);
	}

	// Check if default tabs are empty. If not empty, reorder them.
	if ( $tabs['description'] ) {
		$tabs['description']['priority'] = 5;
	}
	if ( $tabs['shipping'] ) {
		$tabs['shipping']['priority'] = 25;
	}
	if ( $tabs['additional_information'] ) {
		unset( $tabs['additional_information'] );
	}
		$tabs['reviews']['priority'] = 35;

	return $tabs;

}
add_filter( 'woocommerce_product_tabs', 'wps_custom_product_tabs' );
*/


// ================================================================
// Custom Tab Content
/*
function wps_custom_tab_name() {
	echo '<h2>Tab Title</h2>';
	echo get_field( 'product-custom_tab-name' );
}
*/


// ================================================================
// Add Login Form to Checkout
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
add_action( 'woocommerce_before_checkout_billing_form', 'woocommerce_checkout_login_form' );
