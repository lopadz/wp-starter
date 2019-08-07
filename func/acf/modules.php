<?php

// Function to get the modules (clone fiels) for a specific layout (group name)
function wps_acf_get_modules(
	string $layout_name,
	string $module_prefix
) {

	$modules_dir = get_template_directory() . '/parts/modules';

	if ( have_rows( $layout_name ) ) {

		// To be used as section ID
		$section_counter = 0;

		while ( have_rows( $layout_name ) ) {
			the_row();

			// Counter gets passed to includes
			$section_counter++;

			// Use or create as many as necessary
			if ( get_row_layout() === $module_prefix . '-columns' ) :
				include $modules_dir . '/columns.php';

			elseif ( get_row_layout() === $module_prefix . '-gallery' ) :
				include $modules_dir . '/gallery.php';

			elseif ( get_row_layout() === $module_prefix . '-hero' ) :
				include $modules_dir . '/hero.php';

			elseif ( get_row_layout() === $module_prefix . '-html' ) :
				include $modules_dir . '/html.php';

			elseif ( get_row_layout() === $module_prefix . '-slider' ) :
				include $modules_dir . '/slider.php';

			endif;

		}
	}
}
