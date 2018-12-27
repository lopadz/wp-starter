<?php

/*

	Template Name: Custom Template
	To avoid cluttering your theme, create your custom page templates in the templates dir.
	For more on Template Hierarchy: https://developer.wordpress.org/themes/basics/template-hierarchy/

*/


get_header();


if ( have_posts() ) :

	while ( have_posts() ) :

		the_post();

		?>

		<section>

			<div class="container p-v-xl">

				<p class="f-s-5 m-b-sm"><b>Template:</b> <span class="f-info d-block">Custom Template</span></p>

				<p class="f-s-5"><b>Location:</b> <span class="f-info d-block">{theme_dir}/templates/template-name.php</span></p>

				<?php the_content(); ?>

			</div>

		</section>

		<?php

	endwhile;

	wp_reset_postdata();

endif;


get_footer();
