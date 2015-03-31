<?php
if(current_user_can('member')){

	get_header();

	// get user info
	$user_id = get_current_user_id();
	$user = get_user_by('id', $user_id);
	$user_data = $user->data;

	// load meta
	$meta = get_user_meta($user_id);

	// convert single-item array values to their first element
	foreach($meta as $k=>$v){
		if(is_array($v) && count($v) == 1)
			$meta[$k] = $v[0];
	}

	// add email to $meta
	$meta['email'] = $user->data->user_email;

	// image
	$user_image = get_wp_user_avatar_src( $user_id, 'large', null, $user_data->display_name );


	//////////////////
	// RENDER PAGE  //
	//////////////////
	
	// member dates
	$start_year = date('M Y', strtotime($user->user_registered));
	$end_date = date('M Y', strtotime($meta['membership_expiration']));
	?>
	
	<section class="member-card">

		<img class="mc-profile-pic" src="<?php echo $user_image ?>" title="<?php echo $user->display_name ?>" />

		<div class="member-info">
			<h1 class="name"><?php echo $user->display_name ?></h1>
			<h2>Since <?php echo $start_year ?></h2>
			<h2>Expires <?php echo $end_date ?></h2>
		</div>

		<a href="<?php echo get_bloginfo('url') ?>/member-perks/" class="perks secondary-button">Member Perks</a>

	</section>
	<?php

	get_footer();

}else{

	// make them log in first
	$member_card_url = get_bloginfo('url') . '/member-card';
	header('Location: ' . get_bloginfo('url') . '/wp-login.php?redirect_to=' . urlencode($member_card_url));

}