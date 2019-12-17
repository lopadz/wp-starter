<?php

/**
	ACF Name: MODULE - Hero
*/

if ( ! empty( $section_counter ) ) :

	// Module Name Prefix
	$module_prefix = 'module-hero-';

	// Available fields
	$module = array(
		'section_class'   => $module_prefix . 'section_class',
		'container_class' => $module_prefix . 'container_class',
		'type'            => $module_prefix . 'type',
		'txt_color'       => $module_prefix . 'txt_color',
		'bg_color'        => $module_prefix . 'bg_color',
		'bg_img'          => $module_prefix . 'bg_img',
		'overlay_color'   => $module_prefix . 'overlay_color',
		'overlay_opacity' => $module_prefix . 'overlay_opacity',
		'skew_position'   => $module_prefix . 'skew_position',
		'content'         => $module_prefix . 'content',
	);

	// $section_counter is passed from the layout function
	$section_id = 'section-' . $section_counter;

	// ACF Data
	$section_class   = get_sub_field( $module['section_class'] ) ? 'banner ' . get_sub_field( $module['section_class'] ) : null;
	$container_class = get_sub_field( $module['container_class'] ) ? 'container ' . get_sub_field( $module['container_class'] ) : 'container';

	$hero_type = get_sub_field( $module['type'] );

	$hero_text_color = get_sub_field( $module['txt_color'] ) ?: '#000000';
	$hero_bg_color   = get_sub_field( $module['bg_color'] ) ?: '#ffffff';

	$hero_bg_image        = get_sub_field( $module['bg_img'] );
	$hero_overlay_color   = get_sub_field( $module['overlay_color'] ) ?: '#000000';
	$hero_overlay_opacity = get_sub_field( $module['overlay_opacity'] ) ?: '0';

	$hero_skew_position = get_sub_field( $module['skew_position'] );

	$hero_content = get_sub_field( $module['content'] );

	$hero_bg_class = 'bg_'; // fix this?
	$hero_bg_class = 'default' === $hero_type ? 'b' : null; // fix this?
	$hero_bg_class = 'custom' === $hero_type ? '' : null; // fix this?
	$hero_bg_class = 'skew' === $hero_type ? $hero_bg_class . ' skew' : $hero_bg_class; // fix this?

	// CSS
	echo '<style>';
		echo sprintf(
			'%s ',
			esc_attr( $section_id )
		);
	echo '</style>';

	?>


	<section id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo esc_attr( $section_class ); ?>">

		<div class="<?php echo esc_attr( $container_class ); ?>">

			<div class="col-12"></div>

		</div>

		<div class="<?php echo esc_attr( $hero_bg_class ); ?>"></div>

	</section>

	<?php
endif;
