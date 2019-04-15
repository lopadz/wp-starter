<?php

// Check if WooCommerce is Active
if ( class_exists( 'WooCommerce' ) ) {

	// Init WooCommerce Parts
	require get_template_directory() . '/func/woo/start.php';

	// Disable WooCommerce Parts
	require get_template_directory() . '/func/woo/disabled.php';

	// Modify WooCommerce Parts
	require get_template_directory() . '/func/woo/modified.php';

}
