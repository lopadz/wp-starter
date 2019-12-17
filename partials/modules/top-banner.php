<?php

/**
	ACF Name: MODULE - Top Banner
*/

// $acf_data is passed by wps_acf_get_module()
if ( ! empty( $acf_data ) ) :

	// Module Name Prefix
	$module_prefix = 'module-top_banner-';

	// Available fields
	$module = array(
		'enable'             => $module_prefix . 'enable',
		'bg_color'           => $module_prefix . 'bg_color',
		'bg_img'             => $module_prefix . 'bg_image',
		'overlay_color'      => $module_prefix . 'overlay_color',
		'overlay_opacity'    => $module_prefix . 'overlay_opacity',
		'content_type'       => $module_prefix . 'content-type',
		'content_txt_color'  => $module_prefix . 'content-txt_color',
		'content_txt_shadow' => $module_prefix . 'content-txt_shadow',
		'content_title'      => $module_prefix . 'content-title',
		'content_tagline'    => $module_prefix . 'content-tagline',
		'content_custom'     => $module_prefix . 'content-custom',
		'section_class'      => $module_prefix . 'section_class',
		'container_class'    => $module_prefix . 'container_class',
		'row_class'          => $module_prefix . 'row_class',
		'column_class'       => $module_prefix . 'column_class',
	);

	$enable_top_banner = $data[ $module['enable'] ];

	if ( true === $enable_top_banner ) :

		// Background Tab
		$bg_color        = $data[ $module['bg_color'] ] ?: '#ffffff';
		$bg_image_id     = $data[ $module['bg_img'] ] ?: null;
		$bg_image        = ! empty( $bg_image_id ) ? wp_get_attachment_image( $bg_image_id, 'full', false, array( 'class' => 'bg-image' ) ) : null;
		$bg_image        = null === $bg_image ? null : $bg_image;
		$overlay_color   = $data[ $module['overlay_color'] ] ?: '#000';
		$overlay_opacity = $data[ $module['overlay_opacity'] ] ?: '0';

		// Content Tab
		$content_type = $data[ $module['content_type'] ];

		$content_text_color  = $data[ $module['content_txt_color'] ] ?: '#fff';
		$content_text_shadow = true === $data[ $module['content_txt_shadow'] ] ? ' text-shadow' : null;

		$content_title   = $data[ $module['content_title'] ] ?: null;
		$content_tagline = $data[ $module['content_tagline'] ] ?: null;
		$content_custom  = $data[ $module['content_custom'] ] ?: null;

		// Advanced Tab
		$section_class   = ! empty( $data[ $module['section_class'] ] ) ? 'jumbotron background ' . $data[ $module['section_class'] ] : null;
		$container_class = ! empty( $data[ $module['container_class'] ] ) ? 'container ' . $data[ $module['container_class'] ] : 'container';
		$row_class       = ! empty( $data[ $module['row_class'] ] ) ? 'row ' . $data[ $module['row_class'] ] : 'row';
		$column_class    = ! empty( $data[ $module['column_class'] ] ) ? 'col ' . $data[ $module['column_class'] ] . $content_text_shadow : 'col' . $content_text_shadow;

		// CSS
		$css_bg_color        = 'background-color: ' . $bg_color . ';';
		$css_overlay_color   = 'background-color: ' . $overlay_color . ';';
		$css_overlay_opacity = 'opacity: ' . $overlay_opacity . ';';
		$css_text_color      = 'color: ' . $content_text_color . ';';
		echo '<style>';
		echo ' @media ( min-width:992px ) { #site-header { margin-bottom: 0; } }';
		echo sprintf(
			'
			#top-banner { %s }
			#top-banner .bg-overlay { %s %s }
			#top-banner .col { %s }
			',
			esc_html( $css_bg_color ),
			esc_html( $css_overlay_color ),
			esc_html( $css_overlay_opacity ),
			esc_html( $css_text_color )
		);
		echo '</style>';

		?>

		<section id="top-banner" class="<?php echo esc_attr( $section_class ); ?>">

			<div class="<?php echo esc_attr( $container_class ); ?>">

				<div class="<?php echo esc_attr( $row_class ); ?>">

					<div class="<?php echo esc_attr( $column_class ); ?>">

						<?php
						if ( 'page_title' === $content_type ) :
							the_title( '<h1 class="display-4">', '</h1>' );
						elseif ( 'title_tagline' === $content_type ) :
							echo '<h1 class="display-4">' . $content_title . '</h1>';
							echo '<h2>' . $content_tagline . '</h2>';
						elseif ( 'custom' === $content_type ) :
							echo $content_custom;
						endif;
						?>

						<!-- <h1 class="display-4">The Finest
							<span class="d-block h2">Smooth Fiberglass, Textured Fiberglass & Steel Entry Doors</span>
						</h1> -->

					</div>

				</div>

			</div>

			<div class="bg-overlay"></div>

			<?php echo $bg_image; ?>

		</section>

		<?php
	endif; // Close module['enable'] statement

endif;
