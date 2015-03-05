<?php

/*
Returns HTML for a post item that is either business, or organization
$post: $post object returned by WP or ACF. Defaults to current $post
$subtitle: override subtitle default for that post type
*/

function return_directory_item_html($post_object = false, $subtitle = false){
	global $post;

	if($post_object === false)
		$post_object = $post;


  // determine defaults
  if (!$subtitle) {

  	if($post_object->post_type == 'businesses')
  		$tax = 'industry';
    else if($post_object->post_type == 'organizations')
    	$tax = 'organization-type';

		$terms = get_the_terms( $post->ID, $tax );
		if ( $terms && ! is_wp_error( $terms ) ) {
			$subtitles = array();
	  		foreach ( $terms as $term ) {
				$subtitles[] = $term->name;
			}
			$subtitle = join( ", ", $subtitles );
		} else {
			$subtitle = false;
		}
  }

  $name = $post_object->post_title;

  $link = get_permalink($post_object->ID);

	$post_image = get_field( 'logo', $post_object->ID );
	if(empty($post_image))
		$post_image = get_field( 'default_' . $post_object->post_type . '_image', 'option');

	$post_image_src = $post_image['sizes']['square-medium'];

	$to_return = '<li class="directory-list-item ' . $post_object->post_type . '">' .
		'<a href="' .  $link . '" class="thumbnail-image" style="background-image: url(' . $post_image_src . ')"></a>' . 
		'<h3><a href="' . $link . '">' . $name . '</a></h3>';

	if(!empty($subtitle))
		$to_return .= '<h4>' . $subtitle . '</h4>';

	$to_return .= '</li>';

	return $to_return;
}


/*
$post: $post array returned by WP or ACF
$subtitle: override subtitle default of company
*/
function render_directory_item($post = false, $subtitle = false){
	echo return_directory_item_html($post, $subtitle);
}
