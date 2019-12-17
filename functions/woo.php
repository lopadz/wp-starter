<?php

// Check if WooCommerce is Active
if ( class_exists( 'WooCommerce' ) ) {

	// Initial WooCommerce Parts
	wps_get_file( 'functions/woo/start', 'require_once' );

	// Disable WooCommerce Parts
	wps_get_file( 'functions/woo/disabled', 'require_once' );

	// Modify WooCommerce Parts
	wps_get_file( 'functions/woo/modified', 'require_once' );

}
