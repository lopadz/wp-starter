<?php

// Register menus
register_nav_menus(
	[
		'main' => __( 'Main Menu', 'wps' ), // Main nav in header
	]
);

// The Main Menu
function wps_main_nav() {
	wp_nav_menu(
		[
			'container'      => false,  // Remove nav container
			'menu_id'        => 'main-menu',
			'menu_class'     => 'menu', // Adding custom nav class
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'theme_location' => 'main', // Where it's located in the theme
			'depth'          => 5,      // Limit the depth of the nav
		]
	);
}

// Add active class to menu
add_filter( 'nav_menu_css_class', 'wps_modified_nav_menu_css_class', 10, 2 );

function wps_modified_nav_menu_css_class( $classes, $item ) {

	if ( 1 === $item->current || true === $item->current_item_ancestor ) {

		$classes[] = 'active';

	}

	return $classes;
}
