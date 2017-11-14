
// Register Custom Taxonomy
function people_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Roles', 'Taxonomy General Name', 'ecp' ),
		'singular_name'              => _x( 'Role', 'Taxonomy Singular Name', 'ecp' ),
		'menu_name'                  => __( 'People roles', 'ecp' ),
		'all_items'                  => __( 'All Items', 'ecp' ),
		'parent_item'                => __( 'Parent Item', 'ecp' ),
		'parent_item_colon'          => __( 'Parent Item:', 'ecp' ),
		'new_item_name'              => __( 'New Item Name', 'ecp' ),
		'add_new_item'               => __( 'Add New Item', 'ecp' ),
		'edit_item'                  => __( 'Edit Item', 'ecp' ),
		'update_item'                => __( 'Update Item', 'ecp' ),
		'view_item'                  => __( 'View Item', 'ecp' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'ecp' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'ecp' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'ecp' ),
		'popular_items'              => __( 'Popular Items', 'ecp' ),
		'search_items'               => __( 'Search Items', 'ecp' ),
		'not_found'                  => __( 'Not Found', 'ecp' ),
		'no_terms'                   => __( 'No items', 'ecp' ),
		'items_list'                 => __( 'Items list', 'ecp' ),
		'items_list_navigation'      => __( 'Items list navigation', 'ecp' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'people-roles', array( 'people_post_type' ), $args );

}
add_action( 'init', 'people_taxonomy', 0 );