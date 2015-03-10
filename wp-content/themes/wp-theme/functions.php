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

add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'primary', 'Primary Menu' );
}



// ADD CUSTOM PHOTO CROPS
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'square-medium', 300, 300, true );
}


// WP Configuration
include_once('functions/custom_post_types.php');
include_once('functions/custom_taxonomies.php');
include_once('functions/custom_sidebars.php');
include_once('functions/wordpress/enqueue-scripts.php');

// Plugins
include_once('functions/site/acf.php');
include_once('functions/site/posts2posts.php');

// Admin Customization
include_once('functions/wordpress/admin-bar.php');
include_once('functions/wordpress/admin-menu.php');
include_once('functions/wordpress/customize-admin.php');
include_once('functions/wordpress/customize-login.php');

// Helpers
include_once('functions/wordpress/sponsors-helpers.php');
include_once('functions/wordpress/sc-helpers.php'); // misc helpers
include_once('functions/wordpress/utility.php');

// Partial Functions
include_once('partials/person-item.func.php');
include_once('partials/directory-item.func.php');
include_once('partials/article-list.func.php');

// Author slug rewrite
include_once('functions/wordpress/author-slug-rewrite.php');

// Custom Gravity Forms stuff
include_once('functions/wordpress/gravity-forms.php');


// posts filter
include_once('functions/wordpress/filter-post-types.php');

// Member Signin
include_once('functions/site/members-signin.php');

// Robots.txt
include_once('functions/site/robots.php');

// Better User Search Results
include_once('functions/wordpress/user-search-fields.php');

// SECURITY STUFF
define('DISALLOW_FILE_EDIT', true);



