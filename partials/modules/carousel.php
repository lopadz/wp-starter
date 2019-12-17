<?php

/**
	ACF Name: MODULE - Carousel
*/

if ( ! empty( $section_counter ) ) :

	// Module Name Prefix
	$module_prefix = 'module-carousel-';

	// Available fields
	$module = array(
		'section_class'   => $module_prefix . 'section_class',
		'container_class' => $module_prefix . 'container_class',
		'header_enable'   => $module_prefix . 'header_enable',
		'header_class'    => $module_prefix . 'header_class',
		'header_content'  => $module_prefix . 'header_content',
		'footer_enable'   => $module_prefix . 'footer_enable',
		'footer_class'    => $module_prefix . 'footer_class',
		'footer_content'  => $module_prefix . 'footer_content',
		'js_enable'       => $module_prefix . 'js_enable',
		'js_content'      => $module_prefix . 'js_content',
		'carousel_class'  => $module_prefix . 'carousel_class',
		'item_type'       => $module_prefix . 'item_type',
		'cards'           => $module_prefix . 'cards',
		'card_class'      => $module_prefix . 'card_class',
		'card_img'        => $module_prefix . 'card_image',
		'card_body'       => $module_prefix . 'card_body',
		'items'           => $module_prefix . 'items',
		'item_class'      => $module_prefix . 'item_class',
		'item_content'    => $module_prefix . 'item_content',
	);

	// $section_counter is passed from the layout function
	$section_id = 'section-' . $section_counter;

	// ACF Data
	$section_class   = get_sub_field( $module['section_class'] ) ? 'carousel ' . get_sub_field( $module['section_class'] ) : 'carousel';
	$container_class = get_sub_field( $module['container_class'] ) ? 'container ' . get_sub_field( $module['container_class'] ) : 'container';

	// Header Data
	$header_enable  = get_sub_field( $module['header_enable'] );
	$header_class   = true === $header_enable ? get_sub_field( $module['header_class'] ) : null;
	$header_content = true === $header_enable ? get_sub_field( $module['header_content'] ) : null;

	// Footer Data
	$footer_enable  = get_sub_field( $module['footer_enable'] );
	$footer_class   = true === $footer_enable ? get_sub_field( $module['footer_class'] ) : null;
	$footer_content = true === $footer_enable ? get_sub_field( $module['footer_content'] ) : null;

	// JS Data
	$js_enable  = get_sub_field( $module['js_enable'] );
	$js_content = true === $js_enable ? get_sub_field( $module['js_content'] ) : null;

	// Carousel Data
	$carousel_class = get_sub_field( $module['carousel_class'] ) ? 'owl-carousel ' . get_sub_field( $module['carousel_class'] ) : 'owl-carousel';
	$item_type      = get_sub_field( $module['item_type'] );

	// JS Options
	if ( true === $js_enable ) {
		echo '<script>';
			echo $js_content;
		echo '</script>';
	}
	?>

	<section id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo esc_attr( $section_class ); ?>">

		<div class="<?php echo esc_attr( $container_class ); ?>">

			<?php if ( true === $header_enable ) : ?>

				<header class="<?php echo esc_attr( $header_class ); ?>"><?php echo $header_content; ?></header>

			<?php endif; ?>


				<?php
				if ( 'cards' === $item_type ) {

					if ( have_rows( $module['cards'] ) ) {

						echo '<main class="' . esc_attr( $carousel_class ) . '">';

						while ( have_rows( $module['cards'] ) ) {
							the_row();

							$card_img_placeholder = '<img class="card-img-top" src="' . wps_get_assets_uri() . '/img/placeholder-2.png" alt="Image Placeholder">';
							// ACF Data
							$card_class  = get_sub_field( $module['card_class'] ) ? 'card ' . get_sub_field( $module['card_class'] ) : 'card';
							$card_img_id = get_sub_field( $module['card_img'] );
							$card_image  = ! empty( $card_img_id ) ? wp_get_attachment_image( $card_img_id, 'large', false, array( 'class' => 'card-img-top' ) ) : $card_img_placeholder;
							$card_body   = get_sub_field( $module['card_body'] );

							echo '<div class="card">';
								echo $card_image;
								echo '<div class="card-body">' . $card_body . '</div>';
							echo '</div>';

						}

						echo '</main>';
					}
				} elseif ( 'custom' === $item_type ) {
					if ( have_rows( $module['items'] ) ) {

						echo '<main class="' . esc_attr( $carousel_class ) . '">';

						while ( have_rows( $module['items'] ) ) {
							the_row();
							// ACF Data
							$item_class   = get_sub_field( $module['item_class'] ) ?: 'item';
							$item_content = get_sub_field( $module['item_content'] );

							echo '<div class="' . esc_attr( $item_class ) . '">' . $item_content . '</div>';
						}

						echo '</main>';
					}
				}
				?>

			<?php if ( true === $footer_enable ) : ?>

				<footer class="<?php echo esc_attr( $footer_class ); ?>"><?php echo $footer_content; ?></footer>

			<?php endif; ?>

		</div>

	</section>

	<?php
endif;
