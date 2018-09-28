<?php

/*

	Global Theme Footer

*/

// Prevent direct access through URL
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

	</div> <!-- end #site-content -->

	<footer id="site-footer">

		<div class="container collapse p-v-lg">

			<a href="#site-header" id="backToTop" title="Back to the top of the page">Back to Top</a>

			<div class="col-12 p-t-sm">
				<b>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo bloginfo( 'name' ); ?></b>. All Rights Reserved. <span class="credit">Designed &amp; built by <a href="https://blankdistrict.com">Blank District</a>.</span>
			</div>

		</div>

	</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>
