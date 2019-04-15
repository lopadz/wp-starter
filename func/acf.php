<?php

// Add ACF Options Pages
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
			'page_title' => 'Theme Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'icon_url'   => 'dashicons-art',
			'redirect'   => false,
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Theme Header Settings',
			'menu_title'  => 'Header',
			'parent_slug' => 'theme-general-settings',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Theme Footer Settings',
			'menu_title'  => 'Footer',
			'parent_slug' => 'theme-general-settings',
		)
	);

}

// Enable ACF Menu
if ( class_exists( 'acf' ) && false === get_field( 'theme-enable_acf', 'options' ) ) {
	add_filter( 'acf/settings/show_admin', '__return_false' );
}


// Custom colors for ACF's Color Picker
function wps_acf_input_admin_footer() {

	?>

<script type="text/javascript">
	(function($) {

		// Customize color palette of Color Picker field
		acf.add_filter('color_picker_args', function( args, $field ){

			// Colors
			args.palettes = ['#430ae0', '#dd0a50', '#111111', '#ffffff', '#e9e9e9' , '#30a451', '#1266bb', '#e67620', '#d1452d' ]

			return args;
		});

	})(jQuery);	
</script>

	<?php

}

add_action( 'acf/input/admin_footer', 'wps_acf_input_admin_footer' );
