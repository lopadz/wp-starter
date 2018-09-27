<?php

/************* DASHBOARD WIDGETS *****************/

// Disable default dashboard widgets
function disable_default_dashboard_widgets() {
	// Remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); // Comments Widget
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );  // Incoming Links Widget
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );         // Plugins Widget

	// Remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' );  // Quick Press Widget
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );   // Recent Drafts Widget
	remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );         //
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );       //

	// Removing plugin dashboard boxes
	remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );         // Yoast's SEO Plugin Widget

}
add_action( 'admin_menu', 'disable_default_dashboard_widgets' );


/************* CUSTOMIZE ADMIN *******************/

// Custom Backend Footer
function wps_custom_admin_footer() {
	_e( '<span id="footer-thankyou">Developed by <a href="mailto:name@email.com" target="_blank">Your Email Here</a></span>.', 'wps' );
}
add_filter( 'admin_footer_text', 'wps_custom_admin_footer' );

// Login Redirect to Pages
function wps_login_redirect( $url, $request, $user ) {
	if ( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
		if ( $user->has_cap( 'administrator' ) || $user->has_cap( 'author' ) ) {
			$url = admin_url( 'edit.php?post_type=page' );
		} else {
			$url = home_url();
		}
	}
	return $url;
}
add_filter( 'login_redirect', 'wps_login_redirect', 10, 3 );

// Reorder Admin Menu Links
// Based on: https://wordpress.stackexchange.com/questions/276230/how-can-i-control-the-position-in-the-admin-menu-of-items-added-by-plugins?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa
function wps_custom_menu_order( $menu_ord ) {
	if ( ! $menu_ord ) {
		return true;
	}

	return array(
		'index.php', // Dashboard
		'theme-general-settings', // Theme Settings
		'separator1', // First separator
		'edit.php?post_type=page', // Pages
		'edit.php', // Posts
		'upload.php', // Media
		'link-manager.php', // Links
		'edit-comments.php', // Comments
		// 'edit.php?post_type=cpt_name', // Custom Post Type
		'separator2', // Second separator
		'themes.php', // Appearance
		'options-general.php', // Settings
		'tools.php', // Tools
		'users.php', // Users
		'separator-last', // Last separator
		'plugins.php', // Plugins
	);
}
add_filter( 'custom_menu_order', 'wps_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'wps_custom_menu_order', 10, 1 );
