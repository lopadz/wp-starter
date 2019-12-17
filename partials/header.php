<?php

/**
	Global Theme Header
*/

// Prevent direct access through URL
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<!-- Favicons -->
	<!-- Credit: https://realfavicongenerator.net/ -->

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<a class="hidden" href="#site-content">Skip to main content</a>

<div class="site-wrap">

	<header id="site-header" class="container">

		<div class="row p-v-md">

			<div class="col-12 col-md-5 branding">
				<div class="logo">
					<h1><a href="<?php echo esc_url( home_url() ); ?>"><?php echo bloginfo( 'name' ); ?></a></h1>
				</div>
			</div>

		</div>

		<nav class="col-12 main-navigation">

			<?php wps_main_nav(); ?>

		</nav>

	</header>

	<main id="site-content">
