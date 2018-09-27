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

		<a href="#site-header" id="backToTop" title="Back to the top of the page">Back to Top</a>

		<div class="container p-v-lg">
			<div class="col-12">
				<b>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo bloginfo( 'name' ); ?></b>. All Rights Reserved. <span class="credit">Designed &amp; built by <a href="https://blankdistrict.com">Blank District</a>.</span>
			</div>
		</div>

	</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>
