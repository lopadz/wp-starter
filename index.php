<?php

/*
	This file loads the corresponding layout for any post type.
	To avoid cluttering your theme, create your custom layouts in the global dir and load them here.
	For more on Template Hierarchy: https://developer.wordpress.org/themes/basics/template-hierarchy/
*/

// Prevent direct access through URL
if ( ! defined( 'ABSPATH' ) ) :
	exit;

else :
	get_header();

	// Load corresponding layout
	if ( is_404() ) :
		get_template_part( 'global/404' );

	elseif ( is_single() ) :
		get_template_part( 'global/single' );

	elseif ( is_archive() ) :
		get_template_part( 'global/archive' );

	elseif ( is_home() ) :
		get_template_part( 'global/blog' );

	elseif ( is_search() ) :
		get_template_part( 'global/search' );

	else :
		get_template_part( 'global/index' );

	endif;

	get_footer();

endif;
