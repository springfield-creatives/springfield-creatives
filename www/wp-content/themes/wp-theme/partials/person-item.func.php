<?php

	/*
	$user: $user array returned by WP or ACF
	$subtitle: override subtitle default of company
	*/

function render_person_item($user, $subtitle = false){

	if(empty($user))
		return false;

	// get user link
	$link = get_author_posts_url( $user['ID'] );

	// default subtitle to company
	if(!$subtitle){

		// get connected businesses posts
		$connected = get_posts( array(
	        'connected_type' => 'businesses_user',
	        'connected_items' => $user,
			'suppress_filters' => false,
	        'nopaging' => true
	    ) );

		// set the subtitle accordingly
		// TODO: list all businesses if there are multiple
	    if(!empty($connected)){
	    	$subtitle = '<a href="' . $connected[0]->post_title . '">' . $connected[0]->post_title . '</a>';
	    }else{
	    	// get manual text meta and use that, no link
	    	$subtitle = get_field( 'business', 'user_' . $user['ID'] );
	    }

	}

	// set readable name
	$name = $user['user_firstname'] . ' ' . $user['user_lastname'];

	// get image
	$user_image = get_field( 'photo', 'user_' . $user['ID'] );

	$email = $user['user_email'];

	?>
	<li class="person-item">
		<a href="<?php echo $link ?>">
			<img src="<?php echo $user_image['sizes']['square-medium'] ?>" alt="<?php echo $name ?>" />
		</a>
		<h3><a href="<?php echo $link ?>"><?php echo $name ?></a></h3>
		<h4><?php echo $subtitle ?></h4>
		<a href="mailto:<?php echo $email ?>" class="email">Email</a>
	</li>
	<?php
}
?>