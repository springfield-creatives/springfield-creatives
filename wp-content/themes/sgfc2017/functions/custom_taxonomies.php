<?php
// http://codex.wordpress.org/Function_Reference/register_taxonomy



function register_taxonomies()
{

	register_taxonomy(
		'position', 
		array(
			'jobs'
		),
		array(
			'hierarchical' => false,
			'show_ui' => true,
			'public' => false,
			'label' => __('Position'),
			'show_in_nav_menus' => true,
			'labels' => array(
				'add_new_item' => 'Add New Position',
				'all_items' => 'Position'
			),
			'query_var' => true,
			// 'capabilities' => array(
			// 	'manage_terms' => 'editable_taxes',
			// 	'edit_terms' => 'editable_taxes',
			// 	'assign_terms' => 'editable_taxes'
			// )
		)
	);

	// register_taxonomy(
	// 	'job-type', 
	// 	array(
	// 		'jobs'
	// 	),
	// 	array(
	// 		'hierarchical' => false,
	// 		'show_ui' => true,
	// 		'public' => false,
	// 		'label' => __('Job Type'),
	// 		'show_in_nav_menus' => true,
	// 		'labels' => array(
	// 			'add_new_item' => 'Add New Job Type',
	// 			'all_items' => 'Job Type'
	// 		),
	// 		'query_var' => true,
	// 	)
	// );

	register_taxonomy(
		'industry', 
		array(
			'businesses'
		),
		array(
			'hierarchical' => false,
			'show_ui' => true,
			'public' => true,
			'label' => __('Industry'),
			'show_in_nav_menus' => true,
			'labels' => array(
				'add_new_item' => 'Add New Industry',
				'all_items' => 'Industries'
			),
			'query_var' => true,
		)
	);

	register_taxonomy(
		'skills', 
		array(
			'businesses'
		),
		array(
			'hierarchical' => false,
			'show_ui' => true,
			'public' => true,
			'label' => __('Skill/Service'),
			'show_in_nav_menus' => true,
			'labels' => array(
				'add_new_item' => 'Add New Skill/Service',
				'all_items' => 'Skills/Services'
			),
			'query_var' => true,
			// 'capabilities' => array(
			// 	'manage_terms' => 'editable_taxes',
			// 	'edit_terms' => 'editable_taxes',
			// 	'assign_terms' => 'editable_taxes'
			// )
		)
	);
	
	register_taxonomy(
		'organization-type', 
		array(
			'organizations'
		),
		array(
			'hierarchical' => false,
			'show_ui' => true,
			'public' => true,
			'label' => __('Organization Type'),
			'show_in_nav_menus' => true,
			'labels' => array(
				'add_new_item' => 'Add New Type',
				'all_items' => 'Organization Types'
			),
			'query_var' => true,
		)
	);


}

add_action('init', 'register_taxonomies');