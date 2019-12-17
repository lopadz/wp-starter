<?php

// Dummper
function dd(
	$var_dump,
	bool $preformatted = true
	) {
	if ( ! empty( $var_dump ) && true === $preformatted ) {

		echo '<pre>';
		var_dump( $var_dump );
		echo '</pre>';

	} elseif ( ! empty( $var_dump ) && false === $preformatted ) {

		var_dump( $var_dump );

	}
}

// Convert dashes in string to Camel Case
function wps_dashes_to_camel_case( $string, $capitalize_first_character = false ) {

	$str = str_replace( ' ', '', ucwords( str_replace( '-', ' ', $string ) ) );

	if ( ! $capitalize_first_character ) {
		$str[0] = strtolower( $str[0] );
	}

	return $str;
}

// Get full path of file. Defaults to current file.
function wps_get_file_uri( string $filename ) {

	if ( ! empty( $filename ) && is_string( $filename ) ) {

		$file_uri = dirname( $filename ) . '/' . basename( $filename );

		return esc_html( $file_uri );

	}
}

// Display template info to help identify the file being loaded.
function wps_display_layout_info(
	string $layout_name,
	string $filename
	) {

	global $theme_environment;

	if ( ! empty( $filename ) && is_string( $filename ) && ! empty( $layout_name ) && is_string( $layout_name ) ) {

		if ( 'dev' === $theme_environment ) {

			echo '
			<section class="container py-4">
				<div class="row">
					<div class="col shadow pt-3">
						<h2>Layout Name:</h2>
						<p class="lead text-primary">' . esc_html( $layout_name ) . '</p>
						<h3>File Path:</h3>
						<p class="lead text-primary text-break">' . wps_get_file_uri( $filename ) . '</p>
					</div>
				</div>
			</section>';
		}
	}
}

// Path to assets folder
function wps_get_assets_uri() {

	return get_template_directory_uri() . '/assets';

}
