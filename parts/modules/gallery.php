<?php

/**
	Plugin: ACF
	Field Name: MODULE - Gallery
*/

if ( ! empty( $section_counter ) ) :

	// Module Name
	$module_name = 'module-gallery-';

	// Available fields
	$module_fields = array(
		'section_class'   => $module_name . 'section_class',
		'container_class' => $module_name . 'container_class',
		''    => $module_name . '',
	);

	// $section_counter is passed from the layout function
	$section_id = 'section-' . $section_counter;

	// ACF Data
	$section_class   = get_sub_field( $module_fields['section_class'] ) ?: null;
	$container_class = get_sub_field( $module_fields['container_class'] ) ? 'container ' . get_sub_field( $module_fields['container_class'] ) : 'container';

	?>

	<section id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo esc_attr( $section_class ); ?>">

		<main class="<?php echo esc_attr( $container_class ); ?>">


		</main>

	</section>

	<?php
endif;
