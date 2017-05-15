<?php
/**
 * Register new endpoint to use inside My Account page.
 *
 * @see https://developer.wordpress.org/reference/functions/add_rewrite_endpoint/
 */
function sgfc_my_account_profile_endpoints() {
	add_rewrite_endpoint( 'member-profile', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'member-avatar', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'jobs', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'businesses', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'organizations', EP_ROOT | EP_PAGES );
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
	$vars[] = 'jobs';
	$vars[] = 'businesses';
	$vars[] = 'organizations';

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
	$new_items['jobs'] = 'Job Postings';
	$new_items['businesses'] = 'Business Profiles';
	$new_items['organizations'] = 'Organization Profiles';

	// remove sections
	unset($items['downloads']);
	unset($items['subscriptions']);

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

function sgfc_my_account_jobs_endpoint_content() {
	require(TEMPLATEPATH . '/partial-jobs-edit.php');
}
add_action( 'woocommerce_account_jobs_endpoint', 'sgfc_my_account_jobs_endpoint_content' );

function sgfc_my_account_organizations_endpoint_content() {
	require(TEMPLATEPATH . '/partial-organizations-edit.php');
}
add_action( 'woocommerce_account_organizations_endpoint', 'sgfc_my_account_organizations_endpoint_content' );

function sgfc_my_account_businesses_endpoint_content() {
	require(TEMPLATEPATH . '/partial-businesses-edit.php');
}
add_action( 'woocommerce_account_businesses_endpoint', 'sgfc_my_account_businesses_endpoint_content' );




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

$update_notice_added_already = false;

// Process My Account form submission
function sgfc_my_account_profile_form_submission(){
	if($_POST['sgfc_profile_edit'] != 1)
		return;

	global $update_notice_added_already;
	$current_user = wp_get_current_user();

	// save ACF stuff
	$post_id = 'user_' . $current_user->ID;
	do_action('acf/save_post', $post_id);

	// save user stuff (name only at this time)
	$userdata = array(
		'ID' => $current_user->ID,
		'first_name' => $_POST['sgfc_fname'],
		'last_name' => $_POST['sgfc_lname'],
		'display_name' => $_POST['sgfc_fname'] . ' ' . $_POST['sgfc_lname']
	);
	wp_update_user($userdata);

	// add notice
	if(!$update_notice_added_already)
		wc_add_notice('Profile updated!');

	$update_notice_added_already = true; // super hacky :(
}
add_action('wp_loaded', 'sgfc_my_account_profile_form_submission');


// Process Job form submission
function sgfc_my_account_job_profile_form_submission(){
	if($_POST['sgfc_job_profile_edit'] != 1)
		return;

	global $update_notice_added_already;

	// save ACF stuff
	$post_id = $_POST['sgfc_job_profile_id'];
	do_action('acf/save_post', $post_id);

	// save user stuff (name only at this time)
	$post = array(
		'ID' => $post_id,
		'post_title' => $_POST['sgfc_title']
	);
	wp_update_post($post);

	// add notice
	if(!$update_notice_added_already)
		wc_add_notice('Job Posting updated!');

	$update_notice_added_already = true; // super hacky :(
}
add_action('wp_loaded', 'sgfc_my_account_job_profile_form_submission');


// Process Business form submission
function sgfc_my_account_business_profile_form_submission(){
	if($_POST['sgfc_business_profile_edit'] != 1)
		return;

	global $update_notice_added_already;

	// save ACF stuff
	$post_id = $_POST['sgfc_business_profile_id'];
	do_action('acf/save_post', $post_id);

	// save user stuff (name only at this time)
	$post = array(
		'ID' => $post_id,
		'post_title' => $_POST['sgfc_title']
	);
	wp_update_post($post);

	// add notice
	if(!$update_notice_added_already)
		wc_add_notice('Business Profile updated!');

	$update_notice_added_already = true; // super hacky :(
}
add_action('wp_loaded', 'sgfc_my_account_business_profile_form_submission');


// Process Organization form submission
function sgfc_my_account_organzation_profile_form_submission(){
	if($_POST['sgfc_organization_profile_edit'] != 1)
		return;

	global $update_notice_added_already;

	// save ACF stuff
	$post_id = $_POST['sgfc_organization_profile_id'];
	do_action('acf/save_post', $post_id);

	// save user stuff (name only at this time)
	$post = array(
		'ID' => $post_id,
		'post_title' => $_POST['sgfc_title']
	);
	wp_update_post($post);

	// add notice
	if(!$update_notice_added_already)
		wc_add_notice('Organization Profile updated!');

	$update_notice_added_already = true; // super hacky :(
}
add_action('wp_loaded', 'sgfc_my_account_organzation_profile_form_submission');


// Process entry deletion
function sgfc_my_account_entry_deletion_link(){
	if(empty($_GET['sgfc-delete-entry']))
		return;

	global $update_notice_added_already;

	$post_id = intval($_GET['sgfc-delete-entry']);
	$current_user = wp_get_current_user();

	if(!sgfc_has_editor_permission($post_id, $current_user->ID))
		die('You do not have permissions');

	wp_trash_post($post_id);

	// add notice
	if(!$update_notice_added_already)
		wc_add_notice('Entry deleted :\'(');

	$update_notice_added_already = true; // super hacky :(
}
add_action('wp_loaded', 'sgfc_my_account_entry_deletion_link');