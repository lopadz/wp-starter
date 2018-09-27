<?php

/*
	Print Body Classes to help target correct template
*/
function wps_print_template_classes() {
	$classes = get_body_class();
	echo '<code class="wp-templates">';
		echo '<strong>Body Classes:</strong>';
	foreach ( $classes as $class ) {
		echo '<span>' . esc_html( $class ) . '</span> ';
	}
	echo '</code>';
}
add_action( 'get_header', 'wps_print_template_classes' );

/*
	Getting script tags
	Thanks http://wordpress.stackexchange.com/questions/54064/how-do-i-get-the-handle-for-all-enqueued-scripts
*/
function wps_detect_enqueued_scripts() {
	// Hide on WP Admin Panels
	if ( ! is_admin() ) {
		global $wp_scripts;
		echo '<code class="wp-scripts">';
		echo '<strong>WP Scripts:</strong>';
		foreach ( $wp_scripts->queue as $handle ) {
			echo '<span>' . esc_html( $handle ) . '</span> ';
		}
		echo '</code>';
	}
}
add_action( 'wp_print_scripts', 'wps_detect_enqueued_scripts' );
