<?php
/**
 * Page Parts helpers
 *
 * @package ecp
 */


function pageparts_post_type() {

	$labels = array(
		'name'                  => _x( 'Page Parts', 'Post Type General Name', 'ecp' ),
		'singular_name'         => _x( 'Page Part', 'Post Type Singular Name', 'ecp' ),
		'menu_name'             => __( 'Page Parts', 'ecp' ),
		'name_admin_bar'        => __( 'Page Parts', 'ecp' ),
		'archives'              => __( 'Item Archives', 'ecp' ),
		'parent_item_colon'     => __( 'Parent Item:', 'ecp' ),
		'all_items'             => __( 'All Items', 'ecp' ),
		'add_new_item'          => __( 'Add New Item', 'ecp' ),
		'add_new'               => __( 'Add New', 'ecp' ),
		'new_item'              => __( 'New Item', 'ecp' ),
		'edit_item'             => __( 'Edit Item', 'ecp' ),
		'update_item'           => __( 'Update Item', 'ecp' ),
		'view_item'             => __( 'View Item', 'ecp' ),
		'search_items'          => __( 'Search Item', 'ecp' ),
		'not_found'             => __( 'Not found', 'ecp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'ecp' ),
		'featured_image'        => __( 'Featured Image', 'ecp' ),
		'set_featured_image'    => __( 'Set featured image', 'ecp' ),
		'remove_featured_image' => __( 'Remove featured image', 'ecp' ),
		'use_featured_image'    => __( 'Use as featured image', 'ecp' ),
		'insert_into_item'      => __( 'Insert into item', 'ecp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'ecp' ),
		'items_list'            => __( 'Items list', 'ecp' ),
		'items_list_navigation' => __( 'Items list navigation', 'ecp' ),
		'filter_items_list'     => __( 'Filter items list', 'ecp' ),
	);
	$args = array(
		'label'                 => __( 'Page Parts', 'ecp' ),
		'description'           => __( 'Page Parts of ECP', 'ecp' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'taxonomies'            => array( 'pageparts' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-layout',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'rewrite'               => false,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
	);
	register_post_type( 'page_parts', $args );

}
add_action( 'init', 'pageparts_post_type', 0 );



function my_edit_page_parts_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title' ),
		'slug' => __( 'Slug' ),
	);

	return $columns;
}
add_filter( 'manage_edit-page_parts_columns', 'my_edit_page_parts_columns' ) ;


function my_manage_page_parts_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'duration' column. */
		case 'slug' :

			$post_slug=$post->post_name;
			echo $post_slug;
			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}
add_action( 'manage_page_parts_posts_custom_column', 'my_manage_page_parts_columns', 10, 2 );



function get_page_part($path) {
	if($path){
		$ppost = get_page_by_path($path, OBJECT, 'page_parts');
		return $ppost;
	} else {
		return null;
	}
}


function get_page_part_content($path) {
	if($path){
		$ppost = get_page_by_path($path, OBJECT, 'page_parts');
		$content = apply_filters('the_content', $ppost->post_content);
		// $content = $ppost->ID;
  		return $content;
	} else {
		return null;
	}
}

// Shortcode

// Add Shortcode for People
function show_page_part( $atts ) {

	// Attributes
	$a = shortcode_atts(
		array(
			'layout' => 'full',
			'slug' => null,
		),
		$atts
	);

	// error_log($a['slug']);

	$string = '';

	$inpage = get_page_part($a['slug']);
	if(!$inpage){
		return '';
	}
	$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($inpage),'full', false)[0];
	// echo $thumb;
	// $thumb = '';

	$content = apply_filters('the_content', $inpage->post_content);
	$css_class = get_post_meta( $inpage->ID, 'css_class', true );
	$background_color = get_post_meta( $inpage->ID, 'background_color', true );
	$bgrc = '';
	if($background_color) {
		$bgrc = "background-color: $background_color;";
	}

	$string .= $a['layout'] == 'full' ? '</div>' : '';
	$string .= "<div class=\"pagepart $css_class\" style=\"background-image: url($thumb); $bgrc\">";
	$string .= '<div class="pagepart-content">';
	$string .= $content;
	$string .= '</div>';
	$string .= '</div>';
	$string .= $a['layout'] == 'full' ? '<div class="entry-content">' : '';	

	return $string;

}
add_shortcode( 'pagepart', 'show_page_part' );





