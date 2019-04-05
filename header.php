<?php

/*

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

	<header id="site-header">

		<div class="container collapse p-v-md">

			<div class="col sm-12 md-5 branding">
				<div class="logo">
					<h1><a href="<?php echo esc_url( home_url() ); ?>"><?php echo bloginfo( 'name' ); ?></a></h1>
				</div>
			</div>

			<div class="col sm-12 md-7 search">
				<form class="search-form" action="/" method="get">
					<input type="text" placeholder="Looking for..." name="s" id="search" required/>
					<button class="button f-upper f-bold" type="submit">Search</button>
				</form>
			</div>

		</div>

		<a href="javascript:void(0);" class="menu-button">Menu</a>

		<nav class="container expand main-navigation">
			<?php wps_top_nav(); ?>
		</nav>

	</header>

	<div id="site-content">
