<?php

define('SGFC_EVENT_MEETINGS_CAT', 4);



// Enqueue theme custom scripts
add_action('wp_enqueue_scripts', 'custom_load_scripts');
function custom_load_scripts() {

    wp_register_script( 'custom-plugins', get_template_directory_uri() . '/media/scripts/plugins.js', array('jquery'), NULL, TRUE);
    wp_enqueue_script('custom-plugins');

    wp_register_script( 'custom-main', get_template_directory_uri() . '/media/scripts/global.js', array('custom-plugins'), NULL, TRUE);
    wp_enqueue_script('custom-main');

    wp_register_style('theme-css',get_stylesheet_directory_uri().'/style.css', FALSE, NULL, FALSE);
    wp_enqueue_style('theme-css');

    wp_register_style('manual-override',get_stylesheet_directory_uri().'/style-override.css', FALSE, NULL, FALSE);
    wp_enqueue_style('manual-override');

}


remove_action('wp_head', 'wp_generator'); // potential security risk, not useful
remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writer: not useful
remove_action('wp_head', 'wp_shortlink_wp_head'); // remove shortlink, not useful
remove_action('wp_head', 'rsd_link'); // Real Simple Discovery: not useful
remove_action('wp_head', 'feed_links_extra', 3);  // removes comment feed links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

// ADD WORDPRESS FEATURE SUPPORT
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );


add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}




add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'primary', 'Primary Menu' );
  register_nav_menu( 'utility', 'Utility Menu' );
  register_nav_menu( 'footer1', 'Footer Column 1 Menu' );
  register_nav_menu( 'footer2', 'Footer Column 2 Menu' );
  register_nav_menu( 'footer3', 'Footer Column 3 Menu' );
  register_nav_menu( 'footer4', 'Footer Column 4 Menu' );
}


// CUSTOM FILES
include_once('functions/custom_post_types.php');
include_once('functions/custom_taxonomies.php');
include_once('functions/custom_sidebars.php');

// CUSTOM FUNCTIONS
include_once('functions/wordpress/utility.php');
include_once('functions/wordpress/js_site_settings.php');
include_once('functions/site/sponsor-helpers.php');
include_once('functions/site/acf.php');


// SECURITY STUFF
define('DISALLOW_FILE_EDIT', true);



function better_thumbnail($post_id = null, $size = 'large'){

  $thumb_id = get_post_thumbnail_id($post_id);

  if(!empty($thumb_id))
    $src = wp_get_attachment_url( $thumb_id, 'large' );
  else
    $src = get_stylesheet_directory_uri() . '/images/amp_logo.png';

  return $src;

}
