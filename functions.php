<?php

// Prevent direct access through URL
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Fire up engines!
require get_template_directory() . '/func/start.php';

// Custom classes added to body_class
require get_template_directory() . '/func/body-class.php';

// Register scripts and stylesheets
require get_template_directory() . '/func/enqueue.php';

// Register custom menus and menu walkers
require get_template_directory() . '/func/menus.php';

// Register widget areas
require get_template_directory() . '/func/widgets.php';

// Use this as a template for custom post types
require get_template_directory() . '/func/cpt.php';

// Register ACF Options Pages
require get_template_directory() . '/func/acf.php';

// Add pagination links with Foundation's styling
require get_template_directory() . '/func/pagination.php';

// Customize the WordPress login menu
require get_template_directory() . '/func/login.php';

// Customize the WordPress admin
require get_template_directory() . '/func/admin.php';

// Enable Theme Support for Woocommerce & custom functions/hooks
// require get_template_directory() . '/func/woo.php';

// Load to run tests
// require get_template_directory() . '/func/tests.php';
