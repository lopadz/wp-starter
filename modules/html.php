<?php

/**
	Plugin: ACF
	Field Name: MODULE - Plain HTML
*/

if ( ! empty( $section_counter ) ) :

	// Module Name
	$module_name = 'module-html-';

	// Available fields
	$module_fields = array(
		'section_class'   => $module_name . 'section_class',
		'container_class' => $module_name . 'container_class',
		'html_content'    => $module_name . 'content',
	);

	// $section_counter is passed from the layout function
	$section_id = 'section-' . $section_counter;

	// ACF Data
	$section_class   = get_sub_field( $module_fields['section_class'] ) ?: null;
	$container_class = get_sub_field( $module_fields['container_class'] ) ? 'container ' . get_sub_field( $module_fields['container_class'] ) : 'container';
	$html_content    = get_sub_field( $module_fields['html_content'], false, false );

	?>

	<section id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo esc_attr( $section_class ); ?>">

		<main class="<?php echo esc_attr( $container_class ); ?>">

			<?php echo $html_content; ?>

		</main>

	</section>

	<?php
endif;
