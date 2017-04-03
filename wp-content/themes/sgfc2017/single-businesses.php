<?php
global $post;
the_post();

$services = array();
$services_obj = get_the_terms($post, 'skills');
foreach($services_obj as $service)
	$services[] = $service->name;

$contact_links = get_contact_links_arr(get_the_ID());
$social_links = get_social_links_arr(get_the_ID());

$media = get_gallery_arr(get_the_ID());

//edit link TODO
$edit_link = '';

// build the $profile var for the partial
$profile = array(
	"title" => get_the_title(), //required
	"subhead" => $user_business_data['positions'],
	"callout" => $user_business_data['businesses'],
	"featured_img" => get_field('logo')['url'],
	"description" => get_field('about'),
	"contact_links" => $contact_links,
	"social_links" => $social_links,
	"skills" => $services,
	"skill_title" => 'Services',
	"media" => $media,
	"edit-link" => $edit_link,
	"hours" => get_field('hours')
);


require('partial-profile.php'); die;