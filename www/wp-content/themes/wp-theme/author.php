<?php

// temporarily redirect to their configged URL
$url = get_the_author_meta( 'user_url' );

if(empty($url))
	$url = 'https://www.google.com/#q=' . get_the_author_meta( 'user_firstname' ) . ' ' . get_the_author_meta( 'user_lastname' );

header('Location: ' . $url,true,301);
exit;