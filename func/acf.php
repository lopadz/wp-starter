<?php

// Check if ACF is installed and active
if ( class_exists( 'acf' ) && true === is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {

	// Admin Settings
	require get_template_directory() . '/func/acf/admin.php';

	// Options Page
	require get_template_directory() . '/func/acf/options-page.php';

	// ACF Modules (Clone Fields)
	require get_template_directory() . '/func/acf/modules.php';

}
