<?php

/*
	This file loads the corresponding layout for any page post type.
	To avoid cluttering your theme, create your custom layouts in the pages dir and load them here.
	For more on Template Hierarchy: https://developer.wordpress.org/themes/basics/template-hierarchy/
*/

// Prevent direct access through URL
if ( ! defined( 'ABSPATH' ) ) :
	exit;

else :
	get_header();

	// Check and get posts
	if ( have_posts() ) :

		while ( have_posts() ) :

			the_post();

			// Load corresponding layout
			if ( is_front_page() ) :
				get_template_part( 'pages/home' );

				elseif ( is_cart() ) :
					get_template_part( 'global/woo/cart' );

				elseif ( is_checkout() ) :
					get_template_part( 'global/woo/checkout' );

				elseif ( is_account_page() ) :
					get_template_part( 'global/woo/account' );

				else :
					get_template_part( 'global/page' );

			endif;

		endwhile; // End of New Query

		wp_reset_postdata(); // Reset the query to avoid unforseen conflicts

	endif;

		get_footer();

endif;
