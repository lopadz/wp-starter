<?php

/* Custom Post Type Example
This page walks you through creating
a custom post type and taxonomies. You
can edit this one or copy the following code
to create another one.

I put this in a separate file so as to
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.
*/

// let's create the function for the custom type
// (http://codex.wordpress.org/Function_Reference/register_post_type)
function custom_post_example() {
	// creating (registering) the custom type
	register_post_type(
		'custom_type',
		// let's now add all the options for this post type
		array(
			'labels'              => array(
				'name'                  => __( 'Custom Post Type', 'wps' ),               // This is the Title of the Group
				'singular_name'         => __( 'Custom Post Type', 'wps' ),               // This is the individual type
				'all_items'             => __( 'All Custom Post Types', 'wps' ),          // the all items menu item
				'add_new'               => __( 'Add New', 'wps' ),                        // The add new menu item
				'add_new_item'          => __( 'Add New Custom Type', 'wps' ),            // Add New Display Title
				'edit'                  => __( 'Edit', 'wps' ),                           // Edit Dialog
				'edit_item'             => __( 'Edit Custom Post Type', 'wps' ),          // Edit Display Title
				'new_item'              => __( 'New Custom Post Type', 'wps' ),           // New Display Title
				'view_item'             => __( 'View Custom Post Type', 'wps' ),          // View Display Title
				'search_items'          => __( 'Search Custom Post Types', 'wps' ),       // Search Custom Type Title
				'not_found'             => __( 'Nothing found in the Database.', 'wps' ), // This displays if there are no entries yet
				'not_found_in_trash'    => __( 'Nothing found in Trash', 'wps' ),         // This displays if there is nothing in the trash
				'parent_item_colon'     => '',
				// Featured Image Labels
				'featured_image'        => __( 'Featured Image', 'wps' ),
				'set_featured_image'    => __( 'Set Featured Image', 'wps' ),
				'remove_featured_image' => __( 'Remove Image', 'wps' ),
				'use_featured_image'    => __( 'Use Image', 'wps' ),
			),
			'description'         => __( 'This is the example custom post type', 'wps' ), // Custom Type Description
			'public'              => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'show_ui'             => true,
			'query_var'           => true,
			'menu_position'       => 8,                // this is what order you want it to appear in on the left hand side menu
			'menu_icon'           => 'dashicons-book', // the icon for the custom post type menu. uses built-in dashicons (CSS class name)
			'rewrite'             => array(
				'slug'       => 'custom_type', // you can specify its url slug
				'with_front' => false,
			),
			'has_archive'         => 'custom_type', // you can rename the slug here
			'capability_type'     => 'post',
			'hierarchical'        => false, // If TRUE, the posts act as pages/subpages
			// the next one is important, it tells what's enabled in the post editor
			'supports'            => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'page-attributes',
				'excerpt',
				'trackbacks',
				'custom-fields',
				'comments',
				'revisions',
				'sticky',
			),
		)
	);

	// this adds your post categories to your custom post type
	register_taxonomy_for_object_type( 'category', 'custom_type' );
	// this adds your post tags to your custom post type
	register_taxonomy_for_object_type( 'post_tag', 'custom_type' );

}

// adding the function to the WordPress init
add_action( 'init', 'custom_post_example' );

/*
for more information on taxonomies, go here:
http://codex.wordpress.org/Function_Reference/register_taxonomy
*/

// now let's add custom CATEGORIES (these act like categories)
register_taxonomy(
	'custom_cat',
	array( 'custom_type' ), // if you change the name of register_post_type( 'custom_type', then you have to change this
	array(
		'hierarchical'      => true, // if this is true, it acts like categories
		'labels'            => array(
			'name'              => __( 'Custom Categories', 'wps' ),        // name of the custom taxonomy
			'singular_name'     => __( 'Custom Category', 'wps' ),          // single taxonomy name
			'search_items'      => __( 'Search Custom Categories', 'wps' ), // search title for taxomony
			'all_items'         => __( 'All Custom Categories', 'wps' ),    // all title for taxonomies
			'parent_item'       => __( 'Parent Custom Category', 'wps' ),   // parent title for taxonomy
			'parent_item_colon' => __( 'Parent Custom Category:', 'wps' ),  // parent taxonomy title
			'edit_item'         => __( 'Edit Custom Category', 'wps' ),     // edit custom taxonomy title
			'update_item'       => __( 'Update Custom Category', 'wps' ),   // update title for taxonomy
			'add_new_item'      => __( 'Add New Custom Category', 'wps' ),  // add new title for taxonomy
			'new_item_name'     => __( 'New Custom Category Name', 'wps' ), // name title for taxonomy
		),
		'show_admin_column' => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'custom-slug' ),
	)
);

// now let's add custom TAGS (these act like categories)
register_taxonomy(
	'custom_tag',
	array( 'custom_type' ), // if you change the name of register_post_type( 'custom_type', then you have to change this
	array(
		'hierarchical'      => false,   // if this is false, it acts like tags
		'labels'            => array(
			'name'              => __( 'Custom Tags', 'wps' ),         // name of the custom taxonomy
			'singular_name'     => __( 'Custom Tag', 'wps' ),          // single taxonomy name
			'search_items'      => __( 'Search Custom Tags', 'wps' ),  // search title for taxomony
			'all_items'         => __( 'All Custom Tags', 'wps' ),     // all title for taxonomies
			'parent_item'       => __( 'Parent Custom Tag', 'wps' ),   // parent title for taxonomy
			'parent_item_colon' => __( 'Parent Custom Tag:', 'wps' ),  // parent taxonomy title
			'edit_item'         => __( 'Edit Custom Tag', 'wps' ),     // edit custom taxonomy title
			'update_item'       => __( 'Update Custom Tag', 'wps' ),   // update title for taxonomy
			'add_new_item'      => __( 'Add New Custom Tag', 'wps' ),  // add new title for taxonomy
			'new_item_name'     => __( 'New Custom Tag Name', 'wps' ), // name title for taxonomy
		),
		'show_admin_column' => true,
		'show_ui'           => true,
		'query_var'         => true,
	)
);

/*
	looking for custom meta boxes?
	check out this fantastic tool:
	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
*/
