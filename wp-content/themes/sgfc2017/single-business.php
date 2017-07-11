<?php

the_post();

// temporarily redirect to their configged URL
$url = get_field( 'website_url' );

if(empty($url))
	$url = 'https://www.google.com/#q=' . urlencode(get_the_title());

header('Location: ' . $url,true,301);
exit;