<?php

/************* DASHBOARD WIDGETS *****************/

// Disable default dashboard widgets
add_action( 'admin_menu', 'wps_disable_default_dashboard_widgets' );

function wps_disable_default_dashboard_widgets() {
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); // Comments Widget
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );  // Incoming Links Widget
	Remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' );     // Quick Press Widget
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );   // Recent Drafts Widget
	remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );
}


/************* CUSTOMIZE ADMIN *******************/

// Custom Backend Footer
add_filter( 'admin_footer_text', 'wps_custom_admin_footer' );
function wps_custom_admin_footer() {
	_e( '<span id="footer-thankyou">Developed by <a href="mailto:" target="_blank">Your Email Here</a></span>.', 'wps' );
}

// Login Redirect to Pages
add_filter( 'login_redirect', 'wps_login_redirect', 10, 3 );
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


// Function that outputs the contents of the dashboard widget
function wps_dashboard_widget_callback( $post, $callback_args ) {
	echo '
	<div id="custom-widget"></div>
	<script>
		jQuery( function($) {
			$( document ).ready( function() {
				$( "#custom-widget" ).load( "https://url.com/filename.php", function( responseTxt, statusTxt, xhr ) {
					if( "success" === statusTxt )
						$(this).html();
				});
			});
		});
	</script>
	';
}

// Function used in the action hook
function wps_add_dashboard_widgets() {
	add_meta_box( 'id', 'News & Support', 'wps_dashboard_widget_callback', 'dashboard', 'side', 'high' );
}

// Register the new dashboard widget with the 'wp_dashboard_setup' action
add_action( 'wp_dashboard_setup', 'wps_add_dashboard_widgets' );


// Reorder Admin Menu Links
// Based on: https://wordpress.stackexchange.com/questions/276230/how-can-i-control-the-position-in-the-admin-menu-of-items-added-by-plugins?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa
add_filter( 'custom_menu_order', 'wps_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'wps_custom_menu_order', 10, 1 );
function wps_custom_menu_order( $menu_ord ) {
	if ( ! $menu_ord ) {
		return true;
	}

	return array(
		'index.php', // Dashboard
		'edit.php?post_type=acf-field-group', // ACF Custom Fields
		'theme-general-settings', // Theme Settings
		'woocommerce',
		'edit.php?post_type=product',
		'upload.php', // Media
		'separator1', // First separator
		'edit.php?post_type=page', // Pages
		'edit.php', // Posts
		'link-manager.php', // Links
		'edit-comments.php', // Comments
		'separator2', // Second separator
		'themes.php', // Appearance
		'plugins.php', // Plugins
		'tools.php', // Tools
		'users.php', // Users
		'options-general.php', // Settings
		'separator-last', // Last separator
	);
}
