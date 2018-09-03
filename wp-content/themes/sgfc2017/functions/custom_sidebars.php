<?php

// Duplicate this for each sidebar widget area.

register_sidebar(array(
	'name'          => 'Global',
	'id'            => 'global',
	'description'   => '',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>' ));

register_sidebar(array(
    'name'          => 'Job Posting',
    'id'            => 'job-posting',
    'description'   => '',
    'before_widget' => '<div class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>' ));
