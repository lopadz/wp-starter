<?php

// Register Widget Area
function wps_register_sidebars() {
	register_sidebar( array(
		'id'            => 'sidebar1',
		'name'          => __( 'Sidebar 1', 'wps' ),
		'description'   => __( 'The first (primary) sidebar.', 'wps' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}
