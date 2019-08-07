<?php

// Check if ACF Pro is installed
if ( class_exists( 'acf_pro' ) ) {

	// Admin Settings
	require get_template_directory() . '/func/acf/admin.php';

	// Options Page
	require get_template_directory() . '/func/acf/options-page.php';

	// ACF Modules (Clone Fields)
	require get_template_directory() . '/func/acf/modules.php';

}
