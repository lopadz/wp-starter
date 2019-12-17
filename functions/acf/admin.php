<?php

// Enable ACF Menu Link
if ( false === get_field( 'theme-enable_acf', 'options' ) ) {
	add_filter( 'acf/settings/show_admin', '__return_false' );
}

// Custom colors for ACF's Color Picker
// add_action( 'acf/input/admin_footer', 'wps_acf_input_admin_footer' );

function wps_acf_input_admin_footer() {

	?>

	<script type="text/javascript">
		(function($) {

			// Customize color palette of Color Picker field
			acf.add_filter('color_picker_args', function( args, $field ){

				// Colors
				args.palettes = ['#1a1a1a', '#f2f2f2' ]

				return args;
			});

		})(jQuery);	
	</script>

	<?php

}