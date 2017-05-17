<?php
add_action( 'init', 'sc_custom_pages_rewrites_init' );
function sc_custom_pages_rewrites_init(){
    add_rewrite_rule(
        '^member\-card?',
        'index.php?sc-pagename=member-card',
        'top' );
}


add_filter( 'query_vars', 'sc_custom_pages_query_vars' );
function sc_custom_pages_query_vars( $query_vars ){
    $query_vars[] = 'sc-pagename';
    return $query_vars;
}

add_filter( 'query_vars', 'sc_custom_pages_query_vars' );

function sc_custom_pages_template($template){
	global $sc_pagename;
	$sc_pagename = get_query_var('sc-pagename');

	if(empty($sc_pagename))
		return $template;

	// Add specific CSS class by filter
	add_filter( 'body_class', 'sc_page_class_names' );
	function sc_page_class_names( $classes ) {
		global $sc_pagename;

		// add 'class-name' to the $classes array
		$classes[] = 'sc-page-' . $sc_pagename;
		return $classes;
	}

	if(!empty($sc_pagename))
		return get_template_directory() . '/sgfc-' . $sc_pagename . '.php';
}
add_action( 'template_include', 'sc_custom_pages_template' );