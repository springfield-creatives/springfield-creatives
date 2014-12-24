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
	$to_return = '<ul class="directory ' . $class . '">';

	foreach($members->results as $member){
		$to_return .= return_person_item_html($member);
	}

	$to_return .= '</ul>';

	return $to_return;
}

add_shortcode( 'member', 'register_member_shortcode' );







/*
$user: $user array returned by WP or ACF
$subtitle: override subtitle default of company
*/

function return_person_item_html($user, $subtitle = false){

	if(empty($user))
		return false;

	// convert array to object
	if(is_array($user)){
		$user_object = new stdClass();

		foreach ($user as $key => $value){
		    $user_object->$key = $value;
		}
		$user = $user_object;
	}

	// get user link
    $link = get_author_posts_url( $user->ID );

    // default subtitle to company
    if (!$subtitle) {
        // get connected businesses posts
        $connected = get_posts( array(
            'connected_type' => 'businesses_user',
            'connected_items' => $user,
            'suppress_filters' => false,
            'nopaging' => true
        ) );

        // set the subtitle accordingly
        // TODO: list all businesses if there are multiple
        if (!empty($connected)) {
            $subtitle = '<a href="' . get_permalink($connected[0]->ID) . '">' . $connected[0]->post_title . '</a>';
        } else {
            // get manual text meta and use that, no link
            $subtitle = get_field( 'company', 'user_' . $user->ID );
        }
    }

    $name = $user->display_name;
    if (!empty($user->user_firstname) && !empty($user->user_lastname))
        $name = $user->user_firstname . ' ' . $user->user_lastname;

    $email = $user->user_email;

	// get image
	$user_image = get_wp_user_avatar_src( $user->ID, 300, null, $name );

	$email = is_user_logged_in() ? '<a href="mailto:' . $user->user_email . '" class="email">Email</a>' : '';

	$to_return = '<li class="post-list-item user">' .
		'<a href="' .  $link . '" class="thumbnail-image" style="background-image: url(' . $user_image . ')"></a>' . 
		'<h3><a href="' . $link . '">' . $name . '</a></h3>' .
		'<h4>' . $subtitle . '</h4>' .
		$email .
		'</li>';

	return $to_return;
}


/*
$user: $user array returned by WP or ACF
$subtitle: override subtitle default of company
*/
function render_person_item($user, $subtitle = false){
	echo return_person_item_html($user, $subtitle);
}
