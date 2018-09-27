<?php

// Register menus
register_nav_menus(
	array(
		'main' => __( 'Top Menu', 'wps' ),    // Main nav in header
	)
);

// The Top Menu
function wps_top_nav() {
	wp_nav_menu(array(
		'container'      => false,  // Remove nav container
		'menu_id'        => 'main-menu',
		'menu_class'     => 'menu', // Adding custom nav class
		'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'theme_location' => 'main', // Where it's located in the theme
		'depth'          => 5,      // Limit the depth of the nav
		'walker'         => new Menu_Walker(),
	));
}

require 'classes/class-menu-walker.php';

// Add Foundation active class to menu
function required_active_nav_class( $classes, $item ) {
	if ( 1 === $item->current || true === $item->current_item_ancestor ) {
		$classes[] = 'active';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );
