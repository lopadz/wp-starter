<?php

/**
	ACF Name: MODULE - Cards
*/
if ( ! empty( $section_counter ) ) :

	// Module Name Prefix
	$module_prefix = 'module-cards-';

	// Available fields
	$module = array(
		'section_class'   => $module_prefix . 'section_class',
		'container_class' => $module_prefix . 'container_class',
		'row_class'       => $module_prefix . 'row_class',
		'header_enable'   => $module_prefix . 'header_enable',
		'header_class'    => $module_prefix . 'header_class',
		'header_content'  => $module_prefix . 'header_content',
		'footer_enable'   => $module_prefix . 'footer_enable',
		'footer_class'    => $module_prefix . 'footer_class',
		'footer_content'  => $module_prefix . 'footer_content',
		'card'            => [
			'type'          => $module_prefix . 'card_type',
			'header_enable' => $module_prefix . 'card_header_enable',
			'footer_enable' => $module_prefix . 'card_footer_enable',
			'repeater'      => $module_prefix . 'card_repeater',
			'column_class'  => $module_prefix . 'card_column_class',
			'card_class'    => $module_prefix . 'card_class',
			'header'        => $module_prefix . 'card_header',
			'header_class'  => $module_prefix . 'card_header_class',
			'image_class'   => $module_prefix . 'card_image_class',
			'image'         => $module_prefix . 'card_image',
			'body'          => $module_prefix . 'card_body',
			'body_class'    => $module_prefix . 'card_body_class',
			'footer'        => $module_prefix . 'card_footer',
			'footer_class'  => $module_prefix . 'card_footer_class',
			'content'       => $module_prefix . 'card_content',
			'link'          => $module_prefix . 'card_link',
			'link_class'    => $module_prefix . 'card_link_class',
			'title_class'   => $module_prefix . 'card_title_class',
		],
	);

	// $section_counter is passed from the layout function
	$section_id = 'section-' . $section_counter;

	// Options
	$section_class   = get_sub_field( $module['section_class'] ) ?: 'section cards';
	$container_class = get_sub_field( $module['container_class'] ) ? 'container ' . get_sub_field( $module['container_class'] ) : 'container';
	$row_class       = get_sub_field( $module['row_class'] ) ? 'row ' . get_sub_field( $module['row_class'] ) : 'row';

	// Header Data
	$header_enable  = get_sub_field( $module['header_enable'] );
	$header_class   = true === $header_enable ? get_sub_field( $module['header_class'] ) : null;
	$header_content = true === $header_enable ? get_sub_field( $module['header_content'] ) : null;

	// Footer Data
	$footer_enable  = get_sub_field( $module['footer_enable'] );
	$footer_class   = true === $footer_enable ? get_sub_field( $module['footer_class'] ) : null;
	$footer_content = true === $footer_enable ? get_sub_field( $module['footer_content'] ) : null;

	// Cards
	$cards                = $module['card']['repeater'];
	$card_type            = get_sub_field( $module['card']['type'] );
	$card_header_enable   = get_sub_field( $module['card']['header_enable'] );
	$card_footer_enable   = get_sub_field( $module['card']['footer_enable'] );
	$card_img_placeholder = '<img class="img-fluid" src="' . wps_get_assets_uri() . '/img/placeholder-1.png" alt="Image Placeholder">';

	if ( have_rows( $cards ) ) :

		?>

		<section id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo esc_attr( $section_class ); ?>">

			<div class="<?php echo esc_attr( $container_class ); ?>">

				<?php if ( true === $header_enable ) : ?>

					<header class="<?php echo esc_attr( $header_class ); ?>"><?php echo $header_content; ?></header>

				<?php endif; ?>

				<div class="<?php echo esc_attr( $row_class ); ?>">

					<?php
					while ( have_rows( $cards ) ) :
						the_row();

						// ACF Data
						$column_class = get_sub_field( $module['card']['column_class'] ) ?: 'col-12 col-3';
						$card_class   = get_sub_field( $module['card']['card_class'] ) ?: 'card';

						if ( 'default' === $card_type ) :
							$card_header       = get_sub_field( $module['card']['header'] );
							$card_header_class = get_sub_field( $module['card']['header_class'] );
							$card_image_id     = get_sub_field( $module['card']['image'] );
							$card_image_class  = get_sub_field( $module['card']['image_class'] ) ?: 'card-img';
							$card_image        = ! empty( $card_image_id ) ? wp_get_attachment_image( $card_image_id, 'full', false, [ 'class' => $card_image_class ] ) : $card_img_placeholder;
							$card_body         = get_sub_field( $module['card']['body'] );
							$card_body_class   = get_sub_field( $module['card']['body_class'] );
							$card_footer       = get_sub_field( $module['card']['footer'] );
							$card_footer_class = get_sub_field( $module['card']['footer_class'] );

							?>

							<div class="<?php echo esc_attr( $column_class ); ?>">
								<div class="<?php echo esc_attr( $card_class ); ?>">
									<?php if ( true === $card_header_enable ) : ?>
										<div class="card-header <?php echo esc_attr( $card_header_class ); ?>"><?php echo $card_header; ?></div>
									<?php endif; ?>
									<?php echo $card_image; ?>
									<div class="card-body <?php echo esc_attr( $card_body_class ); ?>"><?php echo $card_body; ?></div>
									<?php if ( true === $card_footer_enable ) : ?>
										<div class="card-footer <?php echo esc_attr( $card_footer_class ); ?>"><?php echo $card_footer; ?></div>
									<?php endif; ?>
								</div>
							</div>

							<?php
						elseif ( 'custom' === $card_type ) :
							$card_content = get_sub_field( $module['card']['content'] );
							?>

							<div class="<?php echo esc_attr( $column_class ); ?>">
								<div class="<?php echo esc_attr( $card_class ); ?>">
									<?php echo $card_content; ?>
								</div>
							</div>

							<?php
						elseif ( 'image_overlay' === $card_type ) :
							$card_image_id    = get_sub_field( $module['card']['image'] );
							$card_image_class = get_sub_field( $module['card']['image_class'] ) ?: 'card-img';
							$card_image       = ! empty( $card_image_id ) ? wp_get_attachment_image( $card_image_id, 'full', false, [ 'class' => $card_image_class, 'style' => 'height:auto' ] ) : $card_img_placeholder;
							$card_link        = get_sub_field( $module['card']['link'] );
							$card_link_url    = $card_link['url'] ?: '#';
							$card_link_title  = $card_link['title'];
							$card_link_target = $card_link['target'] ?: '_self';
							$card_link_class  = get_sub_field( $module['card']['link_class'] );
							$card_title_class = get_sub_field( $module['card']['title_class'] );

							?>

							<div class="<?php echo esc_attr( $column_class ); ?>">
								<div class="<?php echo esc_attr( $card_class ); ?>">
								<?php echo $card_image; ?>
								<a href="<?php echo esc_url( $card_link_url ); ?>" class="card-img-overlay d-flex text-decoration-none <?php echo esc_attr( $card_link_class ); ?>">
									<h1 class="<?php echo esc_attr( $card_title_class ); ?>"><?php echo $card_link_title; ?></h1>
								</a>
								</div>
							</div>

						<?php endif; // Card Type ?>

					<?php endwhile; ?>

				</div>

				<?php if ( true === $footer_enable ) : ?>

					<footer class="<?php echo esc_attr( $footer_class ); ?>"><?php echo $footer_content; ?></footer>

				<?php endif; ?>

			</div>

		</section>

		<?php

	endif;

endif;
