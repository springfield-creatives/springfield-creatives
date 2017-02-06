<?php
// Unfortunately, this breaks poorly written plugins that require jquery in the head.
// Load jquery in the footer
// http://stackoverflow.com/a/29817513
// function ds_enqueue_jquery_in_footer( &$scripts ) {
//     if ( ! is_admin() ) {
//         $scripts->registered['jquery']->args = 1;
//         $scripts->registered['jquery-core']->args = 1;
//         $scripts->registered['jquery-migrate']->args = 1;
//     }
// }
// add_action( 'wp_default_scripts', 'ds_enqueue_jquery_in_footer', 11 );
// function enqueue_jquery_in_footer() {
//     wp_enqueue_script( 'jquery-core' );
//     wp_enqueue_script( 'jquery-migrate' );
// }
// add_action( 'init', 'enqueue_jquery_in_footer' );


if(function_exists('acf_add_options_page')){
  acf_add_options_page();
}



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

// CLEAN UP WP HEAD
// remove_action('wp_head', 'start_post_rel_link'); // deprecated
// remove_action('wp_head', 'index_rel_link'); // deprecated

remove_action('wp_head', 'wp_generator'); // potential security risk, not useful
remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writer: not useful
remove_action('wp_head', 'wp_shortlink_wp_head'); // remove shortlink, not useful
remove_action('wp_head', 'rsd_link'); // Real Simple Discovery: not useful
remove_action('wp_head', 'feed_links', 2);  // removes feeds
remove_action('wp_head', 'feed_links_extra', 3);  // removes comment feed links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

// Remove emoji scripts in the head
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('wp_print_styles', 'print_emoji_styles' );

// ADD WORDPRESS FEATURE SUPPORT
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );







add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'primary', 'Primary Menu' );
  register_nav_menu( 'utility', 'Utility Menu' );
}


// CUSTOM FILES
include_once('functions/custom_post_types.php');
include_once('functions/custom_taxonomies.php');
include_once('functions/custom_sidebars.php');

// CUSTOM FUNCTIONS
include_once('functions/wordpress/utility.php');
include_once('functions/wordpress/load_partials.php');
include_once('functions/wordpress/js_site_settings.php');
// include_once('functions/widgets/testimonials.php');

// Add CPT icons as well as seperators to the admin menu
// include_once('functions/wordpress/admin-menu.php');

// ENVIRONMENT STUFF
// include_once('functions/environment.php');

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
