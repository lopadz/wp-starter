<?php

/*
	This file loads the corresponding layout for any post type.
	To avoid cluttering your theme, create your custom views in the layouts dir and load them here.
	For more on Template Hierarchy: https://developer.wordpress.org/themes/basics/template-hierarchy/
*/

// Prevent direct access through URL
if ( ! defined( 'ABSPATH' ) ) :
	exit;

else :

	// Load corresponding template
	if ( is_page() ) :
		wps_get_file( 'layouts/page' );

	elseif ( is_singular( 'single-cpt' ) ) :
		wps_get_file( 'layouts/single/cpt' );

	elseif ( is_single() ) :
		wps_get_file( 'layouts/single' );

	elseif ( is_archive() ) :
		wps_get_file( 'layouts/archive' );

	elseif ( is_search() ) :
		wps_get_file( 'layouts/search' );

	elseif ( is_home() ) :
		wps_get_file( 'layouts/blog' );

	else :
		wps_get_file( 'layouts/404' );

	endif;

endif;
