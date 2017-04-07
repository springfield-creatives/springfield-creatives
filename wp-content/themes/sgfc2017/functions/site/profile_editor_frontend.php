<?php
/**
 * Register new endpoint to use inside My Account page.
 *
 * @see https://developer.wordpress.org/reference/functions/add_rewrite_endpoint/
 */
function sgfc_my_account_profile_endpoints() {
	add_rewrite_endpoint( 'member-profile', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'member-avatar', EP_ROOT | EP_PAGES );
}

add_action( 'init', 'sgfc_my_account_profile_endpoints' );





/**
 * Add new query var.
 *
 * @param array $vars
 * @return array
 */
function sgfc_my_account_profile_custom_query_vars( $vars ) {
	$vars[] = 'member-profile';
	$vars[] = 'member-avatar';

	return $vars;
}

add_filter( 'query_vars', 'sgfc_my_account_profile_custom_query_vars', 0 );





/**
 * Insert the new endpoint into the My Account menu.
 *
 * @param array $items
 * @return array
 */
function sgfc_my_account_profile_link( $items ) {
    
	$new_items = array();

	// rename some default sections
	$items['dashboard'] = 'Membership';
	$items['edit-account'] = 'Login & Social Accounts';

	// start with dashboard still in new array
	$new_items['dashboard'] =  array_shift($items);

	// add custom sections
	$new_items['member-avatar'] = 'Profile Picture';
	$new_items['member-profile'] = 'Profile Details';

	// remove downloads
	unset($items['downloads']);

	$new_items = array_merge($new_items, $items);

  return $new_items;
}

add_filter( 'woocommerce_account_menu_items', 'sgfc_my_account_profile_link' );






/**
 * Endpoint HTML content.
 */
function sgfc_my_account_profile_endpoint_content() {
	require(TEMPLATEPATH . '/partial-profile-details-edit.php');
}

add_action( 'woocommerce_account_member-profile_endpoint', 'sgfc_my_account_profile_endpoint_content' );

function sgfc_my_account_profile_picture_endpoint_content() {
	require(TEMPLATEPATH . '/partial-profile-picture-edit.php');
}

add_action( 'woocommerce_account_member-avatar_endpoint', 'sgfc_my_account_profile_picture_endpoint_content' );




/*
 * Change endpoint title.
 *
 * @param string $title
 * @return string
 */
function sgfc_my_account_profile_endpoint_title( $title ) {
	global $wp_query;

	$is_endpoint = isset( $wp_query->query_vars['member-profile'] );

	if ( $is_endpoint && ! is_admin() && is_main_query() && in_the_loop() && is_account_page() ) {
		// New page title.
		$title = __( 'Edit Member Profile', 'woocommerce' );

		remove_filter( 'the_title', 'sgfc_my_account_profile_endpoint_title' );
	}

	return $title;
}

add_filter( 'the_title', 'sgfc_my_account_profile_endpoint_title' );



// Process My Account form submission
function sgfc_my_account_profile_form_submission(){
	if($_POST['sgfc_profile_edit'] != 1)
		return;

	global $user_ID, $update_notice_added_already;
	get_currentuserinfo();

	// save ACF stuff
	$post_id = 'user_' . $user_ID;
	do_action('acf/save_post', $post_id);

	// save user stuff (name only at this time)
	$userdata = array(
		'first_name' => $_POST['sgfc_fname'],
		'last_name' => $_POST['sgfc_lname'],
		'diplay_name' => $_POST['sgfc_fname'] . ' ' . $_POST['sgfc_lname']
	);

	if(!$update_notice_added_already)
		wc_add_notice('Profile updated!');

	$update_notice_added_already = true; // super hacky
}
add_action('wp_loaded', 'sgfc_my_account_profile_form_submission');