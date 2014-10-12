<?php

	/*
	$person = array(
		'name' => 'Charlie Rosenbury',
		'img' => 'http://path-to-img.com/image.png',
		'subtitle' => 'Really cool guy',
		'company' => array(
			'title' => '40Digits',
			'url'  => 'http://www.springfieldcreatives.com/40digits' //optional
		)
	);
	*/


	// generate company line HTML
	$company = '';
	if( !empty($person['company']) ){
		if( empty($person['company']['url']) )
			$company = $person['company']['title'];
		else
			$company = '<a href="' . $person['company']['url'] . '">' . $person['company']['title'] . '</a>';
	}

?>
<li class="person-item">
	<img src="<?php echo $person['img'] ?>" alt="<?php echo $person['name'] ?>" />
	<h3><?php echo $person['name'] ?></h3>
	<h4><?php echo $person['subtitle'] ?></h4>
	<h5><?php echo $company ?></h5>
</li>