<?php

/**
	ACF Name: MODULE - Column
*/

if ( ! empty( $section_counter ) ) :

	// Module Name Prefix
	$module_prefix = 'module-columns-';

	// Available fields
	$module = array(
		'section_class'   => $module_prefix . 'section_class',
		'container_class' => $module_prefix . 'container_class',
		'row_class'       => $module_prefix . 'row_class',
		'bg_enable'       => $module_prefix . 'bg_enable',
		'bg_class'        => $module_prefix . 'bg_class',
		'header_enable'   => $module_prefix . 'header_enable',
		'header_class'    => $module_prefix . 'header_class',
		'header_content'  => $module_prefix . 'header_content',
		'footer_enable'   => $module_prefix . 'footer_enable',
		'footer_class'    => $module_prefix . 'footer_class',
		'footer_content'  => $module_prefix . 'footer_content',
		'columns'         => $module_prefix . 'column_repeater',
		'column_class'    => $module_prefix . 'column_class',
		'column_content'  => $module_prefix . 'column_content',
	);

	// $section_counter is passed from the layout function
	$section_id = 'section-' . $section_counter;

	// ACF Data
	$section_class   = get_sub_field( $module['section_class'] ) ?: 'section';
	$container_class = get_sub_field( $module['container_class'] ) ? 'container ' . get_sub_field( $module['container_class'] ) : 'container';
	$row_class       = get_sub_field( $module['row_class'] ) ? 'row ' . get_sub_field( $module['row_class'] ) : 'row';

	// Background Data
	$bg_enable = get_sub_field( $module['bg_enable'] );
	$bg_class  = get_sub_field( $module['bg_class'] ) ?: 'bg';

	// Header Data
	$header_enable  = get_sub_field( $module['header_enable'] );
	$header_class   = true === $header_enable ? get_sub_field( $module['header_class'] ) : null;
	$header_content = true === $header_enable ? get_sub_field( $module['header_content'] ) : null;

	// Footer Data
	$footer_enable  = get_sub_field( $module['footer_enable'] );
	$footer_class   = true === $footer_enable ? get_sub_field( $module['footer_class'] ) : null;
	$footer_content = true === $footer_enable ? get_sub_field( $module['footer_content'] ) : null;

	if ( have_rows( $module['columns'] ) ) :

		?>

		<section id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo esc_attr( $section_class ); ?>">

			<div class="<?php echo esc_attr( $container_class ); ?>">

				<?php if ( true === $header_enable ) : ?>

					<header class="<?php echo esc_attr( $header_class ); ?>"><?php echo $header_content; ?></header>

				<?php endif; ?>

				<div class="<?php echo esc_attr( $row_class ); ?>">

					<?php
					while ( have_rows( $module['columns'] ) ) :
						the_row();

						// ACF Data
						$column_class   = get_sub_field( $module['column_class'] ) ?: 'col-12';
						$column_content = get_sub_field( $module['column_content'] );
						?>

						<div class="<?php echo esc_attr( $column_class ); ?>">

							<?php echo $column_content; ?>

						</div>

					<?php endwhile; ?>

				</div>

				<?php if ( true === $footer_enable ) : ?>

					<footer class="<?php echo esc_attr( $footer_class ); ?>"><?php echo $footer_content; ?></footer>

				<?php endif; ?>

			</div>

			<?php if ( true === $bg_enable ) : ?>
				<div class="<?php echo esc_attr( $bg_class ); ?>"></div>
			<?php endif; ?>

		</section>

		<?php

	endif;

endif;
