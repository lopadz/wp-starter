<?php

/**
	Global Theme Footer
*/

// Prevent direct access through URL
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

	</main> <!-- end #site-content -->

	<footer id="site-footer" class="container">

		<div class="row py-3">

			<a href="#site-header" id="backToTop" title="Back to the top of the page">Back to Top</a>

			<div class="col-12 pt-2">
				<b>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo bloginfo( 'name' ); ?></b>. All Rights Reserved. <span class="credit">Designed &amp; built by <a href="https://www.blankdistrict.com">Blank District</a>.</span>
			</div>

		</div>

	</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>
