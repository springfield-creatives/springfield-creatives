<?php
// http://codex.wordpress.org/Function_Reference/register_post_type

function register_CPTs()
{



	// Duplicate this for each CPT.

	// $labels = array(
	// 	'name' => _x('Member', 'post type general name'),
	// 	'singular_name' => _x('Member Item', 'post type singular name'),
	// 	'add_new' => _x('Add New', 'member'),
	// 	'add_new_item' => __('Add New Member Item'),
	// 	'edit_item' => __('Edit Member Item'),
	// 	'new_item' => __('New Member Item'),
	// 	'view_item' => __('View Member Item'),
	// 	'search_items' => __('Search Member'),
	// 	'not_found' =>  __('No Member Items found'),
	// 	'not_found_in_trash' => __('No Member Items found in Trash'),
	// 	'parent_item_colon' => '',
	// 	'menu_name' => 'Member'

	// );
	// $args = array(
	// 	'labels' => $labels,
	// 	'public' => true,
	// 	'publicly_queryable' => true,
	// 	'show_ui' => true,
	// 	'show_in_menu' => true,
	// 	'show_in_nav_menus' => true,
	// 	'query_var' => true,
	// 	'rewrite' => Array('slug'=>'project'),
	// 	'capability_type' => 'post',
	// 	'has_archive' => true,
	// 	'hierarchical' => false,
	// 	'menu_position' => 21,
	// 	'supports' => array('title','page-attributes')
	// );

	// register_post_type('portfolio',$args);

	// Jobs
	//--------------------------------------------------------------------------
	$labels = array(
		'name' => _x('Jobs', 'post type general name'),
		'singular_name' => _x('Job', 'post type singular name'),
		'add_new' => _x('Add New', 'jobs'),
		'add_new_item' => __('Add New Job'),
		'edit_item' => __('Edit Job'),
		'new_item' => __('New Job'),
		'view_item' => __('View Job'),
		'search_items' => __('Search Jobs'),
		'not_found' =>  __('No Jobs found'),
		'not_found_in_trash' => __('No Jobs found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Jobs'

	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => Array(
			'slug' => 'job'
		),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 21,
		'supports' => array(
			'title',
			'editor',
			'page-attributes'
		)
	);

	register_post_type('jobs', $args);

	// Business
	//--------------------------------------------------------------------------
	$labels = array(
		'name' => _x('Businesses', 'post type general name'),
		'singular_name' => _x('Business', 'post type singular name'),
		'add_new' => _x('Add New', 'businesses'),
		'add_new_item' => __('Add New Business'),
		'edit_item' => __('Edit Business'),
		'new_item' => __('New Business'),
		'view_item' => __('View Business'),
		'search_items' => __('Search Businesses'),
		'not_found' =>  __('No Businesses found'),
		'not_found_in_trash' => __('No Businesses found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Businesses'

	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => Array(
			'slug' => 'business'
		),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 21,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'page-attributes'
		)
	);

	register_post_type('businesses', $args);

	// Organization
	//--------------------------------------------------------------------------
	$labels = array(
		'name' => _x('Organizations', 'post type general name'),
		'singular_name' => _x('Organization', 'post type singular name'),
		'add_new' => _x('Add New', 'organizations'),
		'add_new_item' => __('Add New Organization'),
		'edit_item' => __('Edit Organization'),
		'new_item' => __('New Organization'),
		'view_item' => __('View Organization'),
		'search_items' => __('Search Organizations'),
		'not_found' =>  __('No Organizations found'),
		'not_found_in_trash' => __('No Organizations found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Organizations'

	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => Array(
			'slug' => 'organization'
		),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 21,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'page-attributes'
		)
	);

	register_post_type('organizations', $args);

	// Sponsors
	//--------------------------------------------------------------------------
	$labels = array(
		'name' => _x('Sponsors', 'post type general name'),
		'singular_name' => _x('Sponsor', 'post type singular name'),
		'add_new' => _x('Add New', 'sponsors'),
		'add_new_item' => __('Add New Sponsor'),
		'edit_item' => __('Edit Sponsor'),
		'new_item' => __('New Sponsor'),
		'view_item' => __('View Sponsor'),
		'search_items' => __('Search Sponsors'),
		'not_found' =>  __('No Sponsors found'),
		'not_found_in_trash' => __('No Sponsors found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Sponsors'

	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => Array(
			'slug' => 'sponsor'
		),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 21,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'page-attributes'
		)
	);

	register_post_type('sponsors', $args);

	// Committees
	//--------------------------------------------------------------------------
	$labels = array(
		'name' => _x('Committees', 'post type general name'),
		'singular_name' => _x('Committee', 'post type singular name'),
		'add_new' => _x('Add New', 'Committees'),
		'add_new_item' => __('Add New Committee'),
		'edit_item' => __('Edit Committee'),
		'new_item' => __('New Committee'),
		'view_item' => __('View Committee'),
		'search_items' => __('Search Committees'),
		'not_found' =>  __('No Committees found'),
		'not_found_in_trash' => __('No Committees found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Committees'

	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => Array(
			'slug' => 'committee'
		),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 21,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'page-attributes'
		)
	);

	register_post_type('committee', $args);

}

add_action('init', 'register_CPTs');