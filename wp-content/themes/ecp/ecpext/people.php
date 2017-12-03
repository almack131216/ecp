<?php
/**
 * People helpers
 *
 * @package ecp
 */


function people_post_type() {

	$labels = array(
		'name'                  => _x( 'People', 'Post Type General Name', 'ecp' ),
		'singular_name'         => _x( 'Person', 'Post Type Singular Name', 'ecp' ),
		'menu_name'             => __( 'People', 'ecp' ),
		'name_admin_bar'        => __( 'People', 'ecp' ),
		'archives'              => __( 'People Archives', 'ecp' ),
		'attributes'            => __( 'People Attributes', 'ecp' ),
		'parent_item_colon'     => __( 'Parent Item:', 'ecp' ),
		'all_items'             => __( 'All Persons', 'ecp' ),
		'add_new_item'          => __( 'Add New Person', 'ecp' ),
		'add_new'               => __( 'Add New', 'ecp' ),
		'new_item'              => __( 'New Person', 'ecp' ),
		'edit_item'             => __( 'Edit Person', 'ecp' ),
		'update_item'           => __( 'Update Person', 'ecp' ),
		'view_item'             => __( 'View Person', 'ecp' ),
		'view_items'            => __( 'View People', 'ecp' ),
		'search_items'          => __( 'Search Person', 'ecp' ),
		'not_found'             => __( 'Not found', 'ecp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'ecp' ),
		'featured_image'        => __( 'Featured Image', 'ecp' ),
		'set_featured_image'    => __( 'Set featured image', 'ecp' ),
		'remove_featured_image' => __( 'Remove featured image', 'ecp' ),
		'use_featured_image'    => __( 'Use as featured image', 'ecp' ),
		'insert_into_item'      => __( 'Insert into item', 'ecp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Person', 'ecp' ),
		'items_list'            => __( 'List of People', 'ecp' ),
		'items_list_navigation' => __( 'Persons list navigation', 'ecp' ),
		'filter_items_list'     => __( 'Filter People list', 'ecp' ),
	);
	$args = array(
		'label'                 => __( 'People', 'ecp' ),
		'description'           => __( 'People', 'ecp' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'taxonomies'            => array( 'people' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-businessman',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
	);
	register_post_type( 'person', $args );

}
add_action( 'init', 'people_post_type', 0 );



// http://justintadlock.com/archives/2011/06/27/custom-columns-for-custom-post-types
function my_edit_person_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title' ),
		'person_type' => __( 'Person Type' ),
		'persontitle' => __( 'Person Title' ),
	);

	return $columns;
}
add_filter( 'manage_edit-person_columns', 'my_edit_person_columns' ) ;


function my_manage_person_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'person_type' :

			$pt = get_post_meta( $post_id, 'person_type', true );

			if ( empty( $pt ) )
				echo __( '-' );

			else
				echo $pt;

			break;

		case 'persontitle' :

			$pti = get_post_meta( $post_id, 'persontitle', true );

			if ( empty( $pti ) )
				echo __( '-' );

			else
				echo $pti;

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}
add_action( 'manage_person_posts_custom_column', 'my_manage_person_columns', 10, 2 );



// Add Shortcode for People
function show_persons( $atts ) {

	// Attributes
	$a = shortcode_atts(
		array(
			'type' => 'any',
		),
		$atts
	);

	// WP_query
	$args = array(
        'post_type' => 'person',
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key'     => 'person_type',
				'value'   => $a['type'],
				'compare' => '=',
				'type'    => 'CHAR',
            ),
        ),
    );

    $string = '';
    $peoplequery = new WP_Query( $args );
    if( $peoplequery->have_posts() ){
        // $string .= '</div><div class="people-box">';
        $string .= '<div class="people-box">';
        while( $peoplequery->have_posts() ){
            $peoplequery->the_post();
            $title = get_the_title();
            $content = get_the_content();
            $thumbnail = get_the_post_thumbnail_url( null, 'full' );

            $myID = null;
            $mylink = null;
            if (function_exists ( 'get_field' )) {
            	$persontitle = get_field('persontitle');
            }
            $string .= '<div class="person">';
            $string .= '<div class="img">';
			$string .= "<img src=\"$thumbnail\" alt=\"TODO\" />";
			$string .= '</div>';
			$string .= '<div class="text-wrap">';//amcust wrap
			$string .= '<div class="text">';
			// $string .= do_shortcode($content);
			$string .= $content;
			$string .= '</div>';
			$string .= "<div class=\"name\">$title</div>";
			if ( $persontitle ) {
				$string .= "<div class=\"persontitle\">$persontitle</div>";
			}
			$string .= '</div>';
			$string .= '</div>';// [END] amcust wrap
        }
        $string .= '</div>';
        // $string .= '</div><div class="entry-content">';
    }
    wp_reset_postdata();
    return $string;

}
add_shortcode( 'persons', 'show_persons' );

