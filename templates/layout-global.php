<?php

/**
	Template Name: Global Layout
	Plugin: ACF
	Field Name: LAYOUT - Global
*/

get_header();

wps_acf_get_modules( 'layout-global', 'global' );

get_footer();
