<?php
$user_id = get_query_var('author');

// temporarily redirect to their configged URL
$url = get_the_author_meta( 'user_url', $user_id );

if(empty($url))
	$url = 'https://www.google.com/#q=' . get_the_author_meta( 'user_firstname', $user_id ) . ' ' . get_the_author_meta( 'user_lastname', $user_id );

header('Location: ' . $url,true,301);
exit;