<?php

/**
 * @param string $filename
 * Name of file. Avoid slash before path name and .php extension
 * @param string $fetching
 * How the file will be fetched.
 * @param mixed $extra_data
 * Additional data to pass to the file
 */
function wps_get_file(
	string $filename = '',
	string $fetching = 'include_once',
	$extra_data = null
	) {

	$filename = is_string( $filename ) ? get_template_directory() . '/' . $filename . '.php' : null;

	// To pass data from where it's been called
	$extra_data = $extra_data;

	if ( file_exists( $filename ) && ! is_null( $filename ) ) {

		if ( 'include' === $fetching ) :
			include $filename;

		elseif ( 'include_once' === $fetching ) :
			include_once $filename;

		elseif ( 'require' === $fetching ) :
			require $filename;

		elseif ( 'require_once' === $fetching ) :
			require_once $filename;

		endif;

	}

}


function wps_get_header() {

	$header = get_template_directory() . '/partials/header.php';

	if ( file_exists( $header ) ) {
		include_once $header;
	}

}


function wps_get_footer( $extra_data = null ) {

	$footer_data = $extra_data;

	$footer = get_template_directory() . '/partials/footer.php';

	if ( file_exists( $footer ) ) {
		include_once $footer;
	}

}


/**
 * Get our custom content loop
 * @param array $post_data
 * Pass any functions to get data from the post
 */
function wps_content_loop() {

	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();

			the_content();

		}

		wp_reset_postdata();

	}

}


/**
*   Child page conditional
*   @ Accept's page ID, page slug or page title as parameters
*/

function wps_is_child_page( $parent = '' ) {
	global $post;

	$parent_obj   = get_page( $post->post_parent, ARRAY_A );
	$parent       = (string) $parent;
	$parent_array = (array) $parent;

	if ( in_array( (string) $parent_obj['ID'], $parent_array, true ) ) {
		return true;
	} elseif ( in_array( (string) $parent_obj['post_title'], $parent_array, true ) ) {
		return true;
	} elseif ( in_array( (string) $parent_obj['post_name'], $parent_array, true ) ) {
		return true;
	} else {
		return false;
	}
}




