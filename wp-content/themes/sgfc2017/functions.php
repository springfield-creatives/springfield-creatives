<?php

define('SGFC_EVENT_MEETINGS_CAT', 4);

define('SGFC_EDITORS_ACF_ID', 3021);
define('SGFC_MEMBER_PROFILE_ACF_ID', 2814);
define('SGFC_GALLERY_ACF_ID', 813);
define('SGFC_JOB_ACF_ID', 2912);
define('SGFC_BUSINESS_ACF_ID', 410);
define('SGFC_ORGANIZATION_ACF_ID', 410);
define('SGFC_CONTACT_ACF_ID', 2828);
define('SGFC_AVAILABILITY_ACF_KEY', 'field_58e25c883e984');

define('SGFC_JOB_POST_FORM_ID', 29);
define('SGFC_BUSINESS_POST_FORM_ID', 30);
define('SGFC_ORGANIZATION_POST_FORM_ID', 31);

define('SGFC_PROFESSIONAL_MEMBERSHIP_PRODUCT_ID', 2717);
define('SGFC_STUDENT_MEMBERSHIP_PRODUCT_ID', 2718);

global $fa_icons;
$fa_icons = array(

  // social 
  'facebook' => 'fa-facebook',
  'twitter' => 'fa-twitter',
  'instagram' => 'fa-instagram',
  'linkedin' => 'fa-linkedin',
  'google' => 'fa-google-plus',
  'dribbble' => 'fa-dribbble',
  'youtube' => 'fa-youtube',
  'tumblr' => 'fa-tumblr',
  'vimeo' => 'fa-vimeo-square',
  'soundcloud' => 'fa-soundcloud',
  'medium' => 'fa-medium',

  // contact
  'website' => 'fa-external-link',
  'phone' => 'fa-phone',
  'email' => 'fa-envelope-o',
  'address' => 'fa-map-marker',

);


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
add_image_size( 'square', '500', '500', true );
add_theme_support( 'menus' );


add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}




add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'primary', 'Primary Menu' );
  register_nav_menu( 'utility', 'Utility Menu' );
  register_nav_menu( 'handbook', 'Handbook Menu' );
  register_nav_menu( 'footer1', 'Footer Column 1 Menu' );
  register_nav_menu( 'footer2', 'Footer Column 2 Menu' );
  register_nav_menu( 'footer3', 'Footer Column 3 Menu' );
  register_nav_menu( 'footer4', 'Footer Column 4 Menu' );
}


// CUSTOM FILES
include_once('functions/custom_post_types.php');
include_once('functions/custom_taxonomies.php');
include_once('functions/custom_sidebars.php');
include_once('functions/custom_shortcodes.php');

// CUSTOM FUNCTIONS
include_once('functions/wordpress/utility.php');
include_once('functions/wordpress/js_site_settings.php');
include_once('functions/site/sponsor-helpers.php');
include_once('functions/site/sc-helpers.php');
include_once('functions/site/acf.php');
include_once('functions/site/profile_editor_frontend.php');
include_once('functions/site/gravity_forms.php');
include_once('functions/site/member-card-funcs.php');

// WOOCOMMERCE


// // Author slug rewrite
include_once('functions/site/author-slug-rewrite.php');

// SECURITY STUFF
define('DISALLOW_FILE_EDIT', true);




function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');