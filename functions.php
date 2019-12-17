<?php

// Prevent direct access through URL
if ( ! defined( 'ABSPATH' ) ) :
	exit;

else :

	/**
	 * Theme Environment
	 * @var = live, stage, dev
	*/
	$theme_environment = 'dev';
	global $theme_environment;

	// Functions directory
	$functions_directory = get_template_directory() . '/functions/';

	/** Functions' filenames to load.
	 * NOTES:
	 * - No .php extension is needed
	 * - Order is important
	 * - Comment out if not needed
	*/
	$function_files = [
		'utilities',     // Theme Utilities
		'templating',    // Get files, layouts, and templates
		'start',         // Fire up engines!
		'body-class',    // Custom classes added to body_class
		'enqueue',       // Register scripts and stylesheets
		'menus',         // Register custom menus and menu walkers
		'widgets',       // Register widget areas
		'cpt',           // Register custom post types and taxonomies
		'acf',           // Register ACF functions
		'gravity-forms', // Gravity Forms functions
		'woo',           // Woo functions
		'login',         // Customize the WordPress login menu
		'admin',         // Customize the WordPress admin area
		'shortcodes',    // Register shortcodes
		// 'tests',      // Run tests (Uncomment if needed)
	];

	// Loop thru each filename in array
	foreach ( $function_files as $function_file ) {

		// Function path
		$function = $functions_directory . $function_file . '.php';

		// Check if file exists
		if ( file_exists( $function ) ) {

			// Load the function file
			require $function;
		}

	}

endif;
