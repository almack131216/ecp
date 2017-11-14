<?php
/**
 * People helpers
 *
 * @package ecp
 */


function slider_post_type() {

	$labels = array(
		'name'                  => _x( 'Slider', 'Post Type General Name', 'ecp' ),
		'singular_name'         => _x( 'Screen', 'Post Type Singular Name', 'ecp' ),
		'menu_name'             => __( 'Slider', 'ecp' ),
		'name_admin_bar'        => __( 'Slider', 'ecp' ),
		'archives'              => __( 'Slider Archives', 'ecp' ),
		'attributes'            => __( 'Slider Attributes', 'ecp' ),
		'parent_item_colon'     => __( 'Parent Item:', 'ecp' ),
		'all_items'             => __( 'All Screens', 'ecp' ),
		'add_new_item'          => __( 'Add New Screen', 'ecp' ),
		'add_new'               => __( 'Add New', 'ecp' ),
		'new_item'              => __( 'New Screen', 'ecp' ),
		'edit_item'             => __( 'Edit Screen', 'ecp' ),
		'update_item'           => __( 'Update Screen', 'ecp' ),
		'view_item'             => __( 'View Screen', 'ecp' ),
		'view_items'            => __( 'View Slider', 'ecp' ),
		'search_items'          => __( 'Search Screen', 'ecp' ),
		'not_found'             => __( 'Not found', 'ecp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'ecp' ),
		'featured_image'        => __( 'Featured Image', 'ecp' ),
		'set_featured_image'    => __( 'Set featured image', 'ecp' ),
		'remove_featured_image' => __( 'Remove featured image', 'ecp' ),
		'use_featured_image'    => __( 'Use as featured image', 'ecp' ),
		'insert_into_item'      => __( 'Insert into item', 'ecp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Screen', 'ecp' ),
		'items_list'            => __( 'List of Screens', 'ecp' ),
		'items_list_navigation' => __( 'Persons list navigation', 'ecp' ),
		'filter_items_list'     => __( 'Filter Screens list', 'ecp' ),
	);
	$args = array(
		'label'                 => __( 'Post Type', 'ecp' ),
		'description'           => __( 'Slider', 'ecp' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', ),
		'taxonomies'            => array( 'slider' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-images-alt2',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'slider', $args );

}
add_action( 'init', 'slider_post_type', 0 );



