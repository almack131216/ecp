<?php
/**
 * Key services helpers
 *
 * @package ecp
 */


function services_post_type() {

	$labels = array(
		'name'                  => _x( 'Key services', 'Post Type General Name', 'ecp' ),
		'singular_name'         => _x( 'Key service', 'Post Type Singular Name', 'ecp' ),
		'menu_name'             => __( 'Key Services', 'ecp' ),
		'name_admin_bar'        => __( 'Key services', 'ecp' ),
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
		'label'                 => __( 'Key service', 'ecp' ),
		'description'           => __( 'Key services of ECP', 'ecp' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'taxonomies'            => array( 'services' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-screenoptions',
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
	register_post_type( 'service_type', $args );

}
add_action( 'init', 'services_post_type', 0 );



function display_key_services_boxes(){
    $args = array(
        'post_type' => 'service_type',
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );

    $string = '';
    $query = new WP_Query( $args );
    if( $query->have_posts() ){
        $string .= '<div class="four-main-hp site-width">';
        while( $query->have_posts() ){
            $query->the_post();
            $title = get_the_title();
            $content = get_the_content();
            $thumbnail = get_the_post_thumbnail_url( null, 'full' );
            // error_log("THUMB: $thumbnail");
            // $css_class = '';
            if (function_exists ( 'get_field' )) {
            	$css_class = get_field('css_class');
            }
            $string .= <<<COMPO
<style>.four-main-hp .section.$css_class::before {background-image: url('$thumbnail');}</style>
<div class="section $css_class">
<h2>$title</h2>
<div>$content</div>
</div>
COMPO;
        }
        $string .= '</div>';
    }
    wp_reset_postdata();
    // wp_reset_query();
    return $string;
}


function display_key_services_boxes_bottom($current_page_id){
    $args = array(
        'post_type' => 'service_type',
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );

    $string = '';
    $query = new WP_Query( $args );
    if( $query->have_posts() ){
    	$string .= '<h3 class="site-width four-main-bottom-headline">You can also see</h3>';
        $string .= '<div class="four-main-bottom site-width">';
        while( $query->have_posts() ){
            $query->the_post();
            $title = get_the_title();
            $content = get_the_content();
            $thumbnail = get_the_post_thumbnail_url( null, 'full' );
            $myID = null;
            $mylink = null;
            if (function_exists ( 'get_field' )) {
            	$css_class = get_field('css_class');
            	$cp = get_field('corresponding_page');
            	list($myID, $mylink) = get_data_from_linked_page($cp);
            }
            // $content = get_the_content();
            $novisible_class = $current_page_id == $myID ? 'hideme' : '';
            $string .= <<<COMPO
<style>.four-main-bottom .section.$css_class::before {background-image: url('$thumbnail');}</style>
<div class="section $css_class $novisible_class">
<h2>$title</h2>
<div>$content</div>
</div>
COMPO;
        }
        $string .= '</div>';
    }
    wp_reset_postdata();
    // wp_reset_query();
    return $string;
}



function get_data_from_linked_page($post_object){
	$idd = null;
	$mylink = null;
	if ( $post_object ) {
		$post = $post_object;
		setup_postdata( $post ); 
		$idd = $post->ID;  // post_parent ??   get_permalink( $post->ID )    $post->post_name;   basename(get_permalink());
		// $mylink = $post->post_name;
		$mylink = get_permalink( $idd );
		// error_log("id: $idd");
	    wp_reset_postdata();
	}
	return array($idd, $mylink);
	// return $idd;
}


function display_key_services_menu($current_page_id){
    $args = array(
        'post_type' => 'service_type',
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );

    $string = '';
    $myquery = new WP_Query( $args );
    if( $myquery->have_posts() ){
        $string .= '<div class="subheader-submenu"><nav>';
        while( $myquery->have_posts() ){
            $myquery->the_post();
            $title = get_the_title();
            $myID = null;
            $mylink = null;
            if (function_exists ( 'get_field' )) {
            	$css_class = get_field('css_class');
            	$cp = get_field('corresponding_page');
            	// $myID = get_data_from_linked_page($cp);
            	list($myID, $mylink) = get_data_from_linked_page($cp);
            	// error_log("..$myID, $mylink...");
            }
            $active_class = $current_page_id == $myID ? 'active' : '';
            $string .= "<div class=\"item $css_class $active_class\">";
            $string .= "<a href=\"$mylink\">$title</a>";
            $string .= "</div>";
        }
        $string .= '</nav></div>';
    }
    wp_reset_postdata();
    // wp_reset_query();
    return $string;
}


