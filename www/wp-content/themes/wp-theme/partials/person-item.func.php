<?php

	/*
	$user: $user array returned by WP or ACF
	$subtitle: override subtitle default of company
	*/

function render_person_item($user, $subtitle = false){

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
            $subtitle = get_field( 'business', 'user_' . $user->ID );
        }
    }

    $name = $user->display_name;
    if (!empty($user->user_firstname) && !empty($user->user_lastname))
        $name = $user->user_firstname . ' ' . $user->user_lastname;

    $email = $user->user_email;

	// get image
	$user_image = get_avatar( $user->ID, 300, null, $name );

	$email = $user->user_email;

	?>
	<li class="person-item">
		<a href="<?php echo $link ?>">
			<?php echo $user_image ?>
		</a>
		<h3><a href="<?php echo $link ?>"><?php echo $name ?></a></h3>
		<h4><?php echo $subtitle ?></h4>
		<?php
		if(is_user_logged_in()){
			?>
			<a href="mailto:<?php echo $email ?>" class="email">Email</a>
			<?php
		}
		?>
	</li>
	<?php
}
?>