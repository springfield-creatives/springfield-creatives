<?php

$cur_user = wp_get_current_user();

// get user info
$user_id = get_query_var('author');
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
$user_image = get_avatar_url( $user_id, array(
  'size' => 300
));

// description
$user_desc = !empty($meta['about_you']) ? $meta['about_you'] : $meta['description'];
$user_desc = wpautop($user_desc);

// links
$contact_links = get_contact_links_arr($user_id, true, $meta);
$social_links = get_social_links_arr($user_id, true, $meta);

// media
$media = get_gallery_arr($user_id, true);

//edit link
$edit_link = ($cur_user->ID == $user_id) ? get_bloginfo('url') . '/my-account/member-profile/' : '';

// expired? TODO
$expired = user_can( $user_id, 'expired' );

$user_business_data = get_user_business_data($user_id);

$skills = array();
$skills_data = get_field('skills', 'user_' . $user_id);
foreach($skills_data as $skill_term)
	$skills[] = $skill_term->name;

$availability = get_field('availability', 'user_' . $user_id);

// build the $profile var for the partial
$profile = array(
	"title" => $user_data->display_name, //required
	"subhead" => $user_business_data['positions'],
	"callout" => $user_business_data['businesses'],
	"featured_img" => $user_image,
	"description" => $user_desc,
	"contact_links" => $contact_links,
	"social_links" => $social_links,
	"skills" => $skills,
	"skill_title" => 'Skillset',
	"availability" => $availability,
	"media" => $media,
	"edit-link" => $edit_link
);


require('partial-profile.php'); die;