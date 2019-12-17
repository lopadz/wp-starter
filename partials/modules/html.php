<?php

/**
	ACF Name: MODULE - Plain HTML
*/

if ( ! empty( $section_counter ) ) :

	// Module Name Prefix
	$module_prefix = 'module-html-';

	// Available fields
	$module = array(
		'section_class'   => $module_prefix . 'section_class',
		'container_class' => $module_prefix . 'container_class',
		'html_content'    => $module_prefix . 'content',
	);

	// $section_counter is passed from the layout function
	$section_id = 'section-' . $section_counter;

	// ACF Data
	$section_class   = get_sub_field( $module['section_class'] ) ?: null;
	$container_class = get_sub_field( $module['container_class'] ) ? 'container ' . get_sub_field( $module['container_class'] ) : 'container';
	$html_content    = get_sub_field( $module['html_content'], false, false );

	?>

	<section id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo esc_attr( $section_class ); ?>">

		<div class="<?php echo esc_attr( $container_class ); ?>">

			<?php echo $html_content; ?>

		</div>

	</section>

	<?php
endif;
