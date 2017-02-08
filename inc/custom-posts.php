<?php
// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                => _x( 'Services', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Service', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Services', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Services', 'text_domain' ),
		'view_item'           => __( 'View Service', 'text_domain' ),
		'add_new_item'        => __( 'Add New Service', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Service', 'text_domain' ),
		'update_item'         => __( 'Update Service', 'text_domain' ),
		'search_items'        => __( 'Search Service', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'services', 'text_domain' ),
		'description'         => __( 'Services', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-hammer',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'services', $args );

	/* CPT Cases */

	$labels = array(
		'name'                => _x( 'Cases', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Case', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Cases', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Cases', 'text_domain' ),
		'view_item'           => __( 'View Case', 'text_domain' ),
		'add_new_item'        => __( 'Add New Case', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Case', 'text_domain' ),
		'update_item'         => __( 'Update Case', 'text_domain' ),
		'search_items'        => __( 'Search Case', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'cases', 'text_domain' ),
		'description'         => __( 'Cases', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-analytics',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'cases', $args );

	$labels = array(
		'name'                => _x( 'Testimonials', 'Post Type General Name', 'odin' ),
		'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'odin' ),
		'menu_name'           => __( 'Testimonials', 'odin' ),
		'parent_item_colon'   => __( 'Parent Item:', 'odin' ),
		'all_items'           => __( 'All Testimonials', 'odin' ),
		'view_item'           => __( 'View Testimonial', 'odin' ),
		'add_new_item'        => __( 'Add New Testimonial', 'odin' ),
		'add_new'             => __( 'Add New', 'odin' ),
		'edit_item'           => __( 'Edit Testimonial', 'odin' ),
		'update_item'         => __( 'Update Testimonial', 'odin' ),
		'search_items'        => __( 'Search Testimonial', 'odin' ),
		'not_found'           => __( 'Not found', 'odin' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'odin' ),
	);
	$args = array(
		'label'               => __( 'testimonials', 'odin' ),
		'description'         => __( 'Testimonials', 'odin' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-testimonial',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'testimonials', $args );
}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );
