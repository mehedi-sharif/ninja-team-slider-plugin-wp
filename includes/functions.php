<?php 
// Register Custom Post Type
function ntp_custom_post() {

	$labels = array(
		'name'                  => _x( 'sliders', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Team Slider', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Ninga Team Slider', 'text_domain' ),
		'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Team Slider', 'text_domain' ),
		'description'           => __( 'Team Slider Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'supports' => array( 'title' )
	);
	register_post_type( 'team_slider', $args );

}
add_action( 'init', 'ntp_custom_post', 0 );




add_action( 'cmb2_admin_init', 'ntp_cmb2_metabox' );
/**
 * Define the metabox and field configurations.
 */
function ntp_cmb2_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_ntp_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'ntp_metabox',
		'title'         => __( 'Team Slider', 'cmb2' ),
		'object_types'  => array( 'team_slider', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );

	// Add other metaboxes as needed
	$group_field_id = $cmb->add_field( array(
	'id'          => 'ntp_team_group',
	'type'        => 'group',
	'repeatable'  => true, // use false if you want non-repeatable group
	'options'     => array(
		'group_title'   => __( 'Team Member {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
		'add_button'    => __( 'Add Another Member', 'cmb2' ),
		'remove_button' => __( 'Remove Entry', 'cmb2' ),
		'sortable'      => true, // beta
		'closed'     => true, // true to have the groups closed by default
	),
) );

// Id's for group's fields only need to be unique for the group. Prefix is not needed.

    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Member Logo',
        'id'   => 'image',
        'type' => 'file',
    ) );
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Member Name',
        'id'   => 'member_name',
        'type' => 'text',
    ) );
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Designtaiton',
        'id'   => 'member_designation',
        'type' => 'text',
    ) );
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Short Description',
        'id'   => 'member_description',
        'type' => 'textarea',
    ) );


}











