<?php
add_action( 'wp_ajax_mark_member_present', 'sc_mark_member_present' );

function sc_mark_member_present() {

	if(!current_user_can('add_users'))
		exit;

	$event_id = $_POST['eventID'];
	$user_id = $_POST['memberID'];
	$present = $_POST['present'];

	$cur_signed_in = get_post_meta($event_id, 'members_sign_in', true);
	if(empty($cur_signed_in))
		$cur_signed_in = array();

	$already_signed_in = array_search($user_id, $cur_signed_in);

	if($present == 'true'){
		if($already_signed_in === false)
			$cur_signed_in[] = $user_id;
	}else{
		if($already_signed_in !== false){
			array_splice($cur_signed_in, $already_signed_in, 1);
		}
	}

	update_post_meta($event_id, 'members_sign_in', $cur_signed_in);

	wp_die(); // this is required to terminate immediately and return a proper response
}