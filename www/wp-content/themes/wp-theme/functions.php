<?php


// CLEAN UP WP HEAD
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');


// Add jQuery
function sgf_creatives_dat_jquery(){
    wp_enqueue_script('jquery'); 
}
add_action( 'wp_enqueue_scripts', 'sgf_creatives_dat_jquery' );

// ADD WORDPRESS FEATURE SUPPORT
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );


// ADD CUSTOM PHOTO CROPS
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'square-medium', 300, 300, true );
}


// CUSTOM FILES
include_once('functions/custom_post_types.php');
include_once('functions/custom_taxonomies.php');
include_once('functions/custom_sidebars.php');

// CUSTOM FUNCTIONS
include_once('functions/wordpress/utility.php');

// Add CPT icons as well as seperators to the admin menu
include_once('functions/wordpress/customize-admin.php');
include_once('functions/wordpress/customize-login.php');

// ENVIRONMENT STUFF
include_once('functions/environment.php');

// Plugin things
include_once('functions/site/acf.php');
include_once('functions/site/posts2posts.php');

// Partial Functions
include_once('partials/person-item.func.php');

// Author slug rewrite
include_once('functions/wordpress/author-slug-rewrite.php');

// Custom gravity forms stuff
include_once('functions/wordpress/gravity-forms.php');

// cleanup admin bar
include_once('functions/wordpress/admin-bar.php');

// posts filter
include_once('functions/wordpress/filter-post-types.php');

// SECURITY STUFF
define('DISALLOW_FILE_EDIT', true);



