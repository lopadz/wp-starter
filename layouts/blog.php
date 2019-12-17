<?php

/**
 * Default Blog Layout
 */

wps_get_header();

wps_display_layout_info( 'Blog Layout', __FILE__ );

?>

	<section class="container">

		<div class="row">

			<?php
			if ( have_posts() ) :

				while ( have_posts() ) :

					the_post();

					echo '<article class="col">';

					the_content();

					echo '</article>';

				endwhile;

			endif;
			?>

		</div>

	</section>

<?php

wps_get_footer();
