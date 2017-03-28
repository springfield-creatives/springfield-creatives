<?php

/*
Registers a [member] shortcode

Usage:
[member id=1,2,3 class=whatever-class-you-want]
Where id is a comma-separated list of user IDs
*/

function register_member_shortcode($atts, $content = null ) {
	if(empty($atts['id']))
		return;

	// get user objects
	$args = array(
	    'include' => explode(',', $atts['id'])
	);
	$members = new WP_User_Query($args);

	// set class if defined
	$class = !empty($atts['class']) ? $atts['class'] : '';

	if(empty($members->results))
		return 'No members found with id=' . $atts['id'];

	// setup list and echo li's
	$to_return = '<div class="grid small">';

	foreach($members->results as $member){
		$to_return .= return_person_item_html($member);
	}

	$to_return .= '</div>';

	return $to_return;
}

add_shortcode( 'member', 'register_member_shortcode' );
