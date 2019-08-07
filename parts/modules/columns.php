<?php

/**
	Plugin: ACF
	Field Name: MODULE - Columns
*/

if ( ! empty( $section_counter ) ) :

	// Module Name
	$module_name = 'module-columns-';

	// Available fields
	$module_fields = array(
		'section_class'   => $module_name . 'section_class',
		'container_class' => $module_name . 'container_class',
		'column_repeater' => $module_name . 'columns',
		'column_class'    => $module_name . 'column_class',
		'column_content'  => $module_name . 'column_content',
	);

	// $section_counter is passed from the layout function
	$section_id = 'section-' . $section_counter;

	// ACF Data
	$section_class   = get_sub_field( $module_fields['section_class'] ) ?: null;
	$container_class = get_sub_field( $module_fields['container_class'] ) ? 'container ' . get_sub_field( $module_fields['container_class'] ) : 'container';

	if ( have_rows( $module_fields['column_repeater'] ) ) :

		?>

		<section id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo esc_attr( $section_class ); ?>">

			<main class="<?php echo esc_attr( $container_class ); ?>">

				<?php

				while ( have_rows( $module_fields['column_repeater'] ) ) :
					the_row();

					// ACF Data
					$column_class   = get_sub_field( $module_fields['column_class'] ) ? 'col ' . get_sub_field( $module_fields['column_class'] ) : 'col-12';
					$column_content = get_sub_field( $module_fields['column_content'] );
					?>

					<div class="<?php echo esc_attr( $column_class ); ?>">

						<?php echo $column_content; ?>

					</div>

				<?php endwhile; ?>

			</main>

		</section>

		<?php

	endif;

endif;
