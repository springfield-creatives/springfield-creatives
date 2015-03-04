<?php
function sgf_creatives_scripts() {

	if(is_single() || is_author())
		wp_enqueue_script( 'script-name', "//cdn.jsdelivr.net/jquery.slick/1.4.1/slick.min.js", array(), '1.0.0', true );
	
}

add_action( 'wp_enqueue_scripts', 'sgf_creatives_scripts' );
