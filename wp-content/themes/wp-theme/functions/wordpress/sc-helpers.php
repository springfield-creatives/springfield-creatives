<?php
/**
 * Returns business connected to a user
 * @param  WP_User $user
 * @return String       Business name, linked if it's an object
 */

function get_user_business($user){
	$connected = get_posts( array(
	  'connected_type' => 'businesses_user',
	  'connected_items' => $user,
	  'suppress_filters' => false,
	  'nopaging' => true
	) );

	// set the subtitle accordingly
	// TODO: list all businesses if there are multiple
	if (!empty($connected)) {
	    return '<a href="' . get_permalink($connected[0]->ID) . '">' . $connected[0]->post_title . '</a>';
	} else {
	    // get manual text meta and use that, no link
	    return get_field( 'company', 'user_' . $user->ID );
	}
}

/**
 * Returns thumbnail image for a given post
 * @param  Integer $post_id
 * @param  String $post_type
 * @param  String|Integer $size
 */

function get_object_image_src($post_id, $post_type = false, $size = 'square-medium'){

	// get post type if not supplied
	if(!$post_type)
		$post_type = get_post_type($post_id);

	if($post_type == 'user'){
		// change size default
		if(!is_integer($size))
			$size = 300;

		// user photo
		return get_wp_user_avatar_src( $post_id, $size, null );

	}else if($post_type == 'jobs'){

		// get connected business/organization and use that
		return get_object_image_src(get_field('company', $post_id, false, $size));

	}else if($post_type == 'organizations' || $post_type == 'businesses'){

		// get connected business/organization and use that
		$post_image = get_field( 'logo', $post_id );
		if(!empty($post_image))
			return $post_image['sizes'][$size];

	}else{

		// everything else
		
		// check if there's a featured image
		if(has_post_thumbnail($post_id)){
			$featured_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
			return is_array($featured_src) ? $featured_src[0] : $featured_src;
		}
		
		// try hero image
		$hero_image = get_field( 'hero_image' );
		if( !empty($hero_image) )
			return $hero_image['sizes'][$size];

	}


	// return default image
	$default = get_field( 'default_' . $post_type . '_image', 'option');
	return $default['sizes'][$size];

}

/**
 * Get an array for use in contact links
 * @param  Integer $id 		Post or author id
 * @param  string $type 
 * @param  Array $meta		Meta values if already loaded
 * @return Array
 */
function get_contact_links_arr($id, $is_user = false, $meta){

	$contact_links = array();

	// if meta wasn't passed in, load it now.
	if(empty($meta)){
		if($is_user){
			$post_id =  "user_" . $id;
			$userdata = get_userdata($id);
		}else{
			$post_id = $id;
		}

		$meta = array(
			'phone_number' => get_field('phone_number', $post_id),
			'website_url' => get_field('website_url', $post_id),
			'email' => $type == "user" ? $userdata->user_email : get_field('email', $post_id),
			'address_one' => get_field('address_one', $post_id),
			'address_two' => get_field('address_two', $post_id),
			'city' => get_field('city', $post_id),
			'state' => get_field('state', $post_id),
			'zip' => get_field('zip', $post_id)
		);
	}

	// email
	$contact_links['email'] = array(
		'title' => $meta['email'],
		'url' => 'mailto:' . $meta['email']
	);

	// website
	$contact_links['website'] = array(
		'title' => str_replace('http://', '', $meta['website_url']), // no http://
		'url' => $meta['website_url']
	);

	// phone
	$contact_links['phone'] = array(
		'title' => $meta['phone_number'],
		'url' => 'tel:' . preg_replace('/\D+/', '', $meta['phone_number']) // just numbers
	);

	// address
	if(!empty($meta['address_one'])){
		
		$lines = array($meta['address_one']);
		
		if(!empty($meta['address_two']))
			$lines[] = $meta['address_two'];

		$lines[] = $meta['city'] . ' ' . $meta['state'] . ' ' . $meta['zip'];

		$contact_links['address'] = array(
			'title' => implode('<br />', $lines),
			'url' => 'https://www.google.com/maps/place/' . urlencode(implode(', ', $lines))
		);
	}

	return $contact_links;
	
}




/**
 * Get an array for use in social links
 * @param  Integer $id 		Post or author id
 * @param  string $type 
 * @param  Array $meta		Meta values if already loaded
 * @return Array
 */
function get_social_links_arr($id, $is_user = false, $meta){

	$social_links = array();

	$field_keys = array(
		'facebook_url' => array(
			'key' => 'facebook',
			'nice_name' => 'Facebook'
		),
		'twitter_url' => array(
			'key' => 'twitter',
			'nice_name' => 'Twitter'
		),
		'instagram_url' => array(
			'key' => 'instagram',
			'nice_name' => 'Instagram'
		),
		'google_url' => array(
			'key' => 'google',
			'nice_name' => 'Google+'
		),
		'dribbble_url' => array(
			'key' => 'dribbble',
			'nice_name' => 'Dribbble'
		),
		'youtube_url' => array(
			'key' => 'youtube',
			'nice_name' => 'Youtube'
		),
		'tumblr_url' => array(
			'key' => 'tumblr',
			'nice_name' => 'Tumblr'
		),
		'vimeo_url' => array(
			'key' => 'vimeo',
			'nice_name' => 'Vimeo'
		),
		'soundcloud_url' => array(
			'key' => 'soundcloud',
			'nice_name' => 'SoundCloud'
		),
	);

	if(empty($meta)){

		$meta = array();
		$post_id = $is_user ? 'user_' . $id : $id;

		foreach($field_keys as $meta_key => $data){
			$meta[$meta_key] = get_field($meta_key, $post_id);
		}

	}

	foreach($field_keys as $meta_key => $data){
		if(!empty($meta[$meta_key]))
			$social_links[$data['key']] = array(
				'url' => $meta[$meta_key],
				'title' => $data['nice_name']
			);
	}

	return $social_links;

}

/**
 * Get an array for use in portfolio
 * @param  Integer $id 		Post or author id
 * @param  string $type 
 * @return Array
 */
function get_gallery_arr($id, $is_user = false){

	$media = array();
	
	$post_id = $is_user ? 'user_' . $id : $id;

	$media_rows = get_field('media_gallery', $post_id); 

	if(empty($media_rows))
		return $media;

	foreach($media_rows as $row){

		if($row['media_type'] == 'image'){

			$image = $row['image_src'];

			if(isset($image['sizes']['square-medium']))
				$thumb = $image['sizes']['square-medium'];
			else
				$thumb = $image['url'];

			$src = $image['url'];

		}else{

			$src = $row['video_url'];
			if(!empty($row['thumbnail'])){

				// they provided a video thumb
				if(isset($row['thumbnail']['sizes']['square-medium']))
					$thumb = $row['thumbnail']['sizes']['square-medium'];
				else
					$thumb = $row['url'];

			}else{
				$thumb = get_field('default_video_thumbnail', 'option');
			}

		}

		$media[] = array(
			'type' => $row['type'],
			'title' => $row['title'],
			'thumb' => $thumb,
			'src' => $src,
		);

	}

	return $media;
}