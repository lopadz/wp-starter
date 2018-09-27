<?php

/*

	Template Name: Sidebar on Left

*/


get_header();


if ( have_posts() ) :

	while ( have_posts() ) :

		the_post();

		?>

		<section>
			<div class="container">
				<div class="col-12">
					<p class="f-s-5 m-b-sm"><b>Template:</b> <span class="f-info d-block">Sidebar on Left</span></p>
					<p class="f-s-5"><b>Location:</b> <span class="f-info d-block">{theme_dir}/template/sidebar-left.php</span></p>
				</div>
			</div>
		</section>

		<section>

			<div class="container">

				<?php get_template_part( 'partials/sidebar' ); ?>

				<?php get_template_part( 'partials/content' ); ?>

			</div>

		</section>

		<?php
		the_content();

	endwhile;

	wp_reset_postdata();

endif;


get_footer();
