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
				args.palettes = ['#4a68b0', '#009b7d', '#111111', '#ffffff', '#e9e9e9' , '#1bbd49', '#1b86f0', '#df701b', '#e21f19' ]

				return args;
			});

		})(jQuery);	
	</script>

	<?php

}
