<?php
/**
 * Queries all posts that are Sponsors. As if "sponsors" were a CPT.
 * @param  integer $min_level Minimum sponsorship level to fetch
 * @param  array   $args      Additional WP_Query arguments
 * @return array              Array of Sponsor data by level
 */
function get_sponsors($min_level = 1, $user_args = array()) {

	global $post;

	$args = array(
		"post_type" => array( 'businesses', 'organizations' ),
		"posts_per_page" => "-1",
		'orderby' => 'title',
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'compare' => '>=',
				'key' => 'sponsor_level',
				'value' => $min_level,
				'type' => 'numeric'
			),
			array(
				'key' => 'is_sponsor',
				'value' => true
			)
		)
	);

	// merge/replace query args
	$args = array_merge_recursive($args, $user_args);

	$sponsors_query = new WP_Query($args);

	// will hold all our sponsor results
	$sponsors = array();

	while($sponsors_query->have_posts()): $sponsors_query->the_post();

		$sponsor_logo = get_field('sponsor_logo');

		if(empty($sponsor_logo))
			$sponsor_logo = get_field('logo');

		if(empty($sponsor_logo))
			$sponsor_logo = get_field( 'default_' . get_post_type() . '_image', 'option');

		$sponsor_url = get_field('sponsor_url');

		if(empty($sponsor_url))
			$sponsor_url = get_field('website_url');

		//store each sponsor by level
		$sponsors[ intval(get_field('sponsor_level')) ][] = array(
			'name' => get_the_title(),
			'logo' => $sponsor_logo,
			'link' => $sponsor_url,
			'post' => $post
		);

	endwhile;

	wp_reset_postdata();

	// sort sponsors by level in reverse (so Gold level is first)
	krsort($sponsors);

	return $sponsors;
}


$sc_sponsorship_level_names = array(
	1 => 'Business',
	2 => 'Bronze',
	3 => 'Silver',
	4 => 'Gold'
);