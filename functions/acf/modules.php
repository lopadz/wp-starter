<?php

// Retrieves a SINGLE module (clone field)
function wps_acf_get_module(
	string $field_name,
	string $module_filename,
	int $post_id
	) {

	// Get ACF Data which is passed to the include file
	$acf_data = get_field( $field_name, $post_id );

	// Module filepath
	$modules_dir     = get_template_directory() . '/partials/modules';
	$module_filepath = $modules_dir . '/' . $module_filename . '.php';

	// Get the module
	include $module_filepath;

}


// Retrieves MULTIPLE modules (clone fieldz)
function wps_acf_get_modules( array $module_data ) {

	$modules_dir = get_template_directory() . '/partials/modules';

	$flexible_content = $module_data['flexible_content'];
	$field_prefix     = $module_data['field_prefix'];
	$modules          = $module_data['layouts'];

	if ( have_rows( $flexible_content ) ) {

		// To be used as section ID
		$section_counter = 0;

		while ( have_rows( $flexible_content ) ) {
			the_row();

			// Counter gets passed to includes
			$section_counter++;

			foreach ( $modules as $module ) {
				if ( get_row_layout() === $field_prefix . '-' . $module ) {
					$module_filename = '/' . $module . '.php';
					include $modules_dir . $module_filename;
				}
			}
		}
	}
}

