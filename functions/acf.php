<?php

// Check if ACF is installed and active
if ( class_exists( 'acf' ) ) {

	// Admin Settings
	wps_get_file( 'functions/acf/admin', 'require_once' );

	// Options Page
	wps_get_file( 'functions/acf/options-page', 'require_once' );

	// ACF Modules (Clone Fields)
	wps_get_file( 'functions/acf/modules', 'require_once' );
}
