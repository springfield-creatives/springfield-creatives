<?php

function p2p_users_companies(){

	// Users and Companies
	p2p_register_connection_type( array(
	    'name' => 'businesses_user',
	    'from' => 'businesses',
	    'to' => 'user',
	    'reciprocal' => true,

		'fields' => array(
	        'position' => array(
	            'title' => 'Position at Company',
	            'type' => 'text',
	        ),
	    ),

	    'admin_box' => array(
			'show' => 'any',
			'context' => 'advanced'
		)
	) );

	// Users and Organizations
	p2p_register_connection_type( array(
	    'name' => 'organizations_user',
	    'from' => 'organizations',
	    'to' => 'user',
	    'reciprocal' => true,

		'fields' => array(
	        'position' => array(
	            'title' => 'Role in Organization',
	            'type' => 'text',
	        ),
	    ),

	    'admin_box' => array(
			'show' => 'any',
			'context' => 'advanced'
		)
	) );

}

add_action( 'p2p_init', 'p2p_users_companies' );

?>