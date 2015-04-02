<?php
function sgf_creatives_scripts() {

	// slick and fancybox
	if(is_single() || is_author()){
		wp_enqueue_script( 'slick', "//cdn.jsdelivr.net/jquery.slick/1.4.1/slick.min.js", array(), '1.0.0', true );
		wp_enqueue_script( 'fancybox', get_template_directory_uri() . "/assets/scripts/vendor/jquery.fancybox.pack.js", array(), '1.0.0', true );
		wp_enqueue_script( 'fancybox-media', get_template_directory_uri() . "/assets/scripts/vendor/jquery.fancybox-media.js", array(), '1.0.0', true );
	}

	// font awesome
	wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
	
	// main css
	wp_enqueue_style( 'sc-css', get_template_directory_uri() . '/style.css', array(), '1.0.2' );



}

add_action( 'wp_enqueue_scripts', 'sgf_creatives_scripts' );
