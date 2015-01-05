<?php
// http://codex.wordpress.org/Function_Reference/register_taxonomy



function register_taxonomies() {

	register_taxonomy(
		'industry', // taxononmy ID. Make this unique from CPTs and Pages to avoid URL rewrite headaches.
		array(
			'jobs',
			'businesses'
		),
		array(
			'hierarchical' => true,
			'show_ui' => true,
			'public' => true,
			'label' => __('Industry'),
			'show_in_nav_menus' => true,
			'labels' => array(
				'add_new_item' => 'Add New Industry'
			),
			'query_var' => true,
		)
	);

	register_taxonomy(
		'organization-type', // taxononmy ID. Make this unique from CPTs and Pages to avoid URL rewrite headaches.
		array(
			'organizations'
		),
		array(
			'hierarchical' => true,
			'show_ui' => true,
			'public' => true,
			'label' => __('Organization Type'),
			'show_in_nav_menus' => true,
			'labels' => array(
				'add_new_item' => 'Add New Type'
			),
			'query_var' => true,
		)
	);

}

add_action('init', 'register_taxonomies');