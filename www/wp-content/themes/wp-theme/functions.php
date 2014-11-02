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
include_once('functions/wordpress/admin-menu.php');

// ENVIRONMENT STUFF
include_once('functions/environment.php');

// Plugin things
include_once('functions/site/acf.php');
include_once('functions/site/posts2posts.php');

// Partial Functions
include_once('partials/person-item.func.php');
include_once('partials/member-item.func.php');

// Author slug rewrite
include_once('functions/wordpress/author-slug-rewrite.php');

include_once('functions/wordpress/gravity-forms.php');

// SECURITY STUFF
define('DISALLOW_FILE_EDIT', true);

// -----------------------------------------------------------------------------
// DO NOT EDIT BELOW THIS LINE ~ Fred

function sgf_filter_post_types ($query) {

    // Skip if running a search
    if (!empty($_GET['s']))
        return false;

    // Skip if not main query
    if (
        !$query->is_main_query() ||
        !$query->is_post_type_archive()
    ) {
        return false;
    }

    // This may throw a gigantic error, so try to catch the mug
    try {
        // Figure out what we're filtering
        $query_string = $_SERVER['QUERY_STRING'];
        preg_match_all('/filter-(.[^=]*)/i', $query_string, $taxonomies);
        $taxonomies = $taxonomies[1];
    } catch (Exeption $e) {
        // Exit this script
        return false;
    }

    // Setup the taxonomy query
    $tax_query = array();
    $tax_query['relation'] = 'OR';

    for ($i = 0, $length = count($taxonomies); $i < $length; $i++) {
        $taxonomy = $taxonomies[$i];
        $filter = '';

        // Check to make sure it exists, and if it applies to the post type
        if (!taxonomy_exists($taxonomy))
            continue;

        // Check if taxonomy is attached to post type
        $attached_taxonomies = get_object_taxonomies($query->query_vars['post_type']);
        if (empty($attached_taxonomies) || !in_array($taxonomy, $attached_taxonomies))
            continue;

        if (empty($_GET['filter-' . $taxonomy])) {
            continue;
        } else {
            $filter = $_GET['filter-' . $taxonomy];
        }

        // Logic to get default settings
        if ($filter == 'default') {
            continue;
        }

        // Finally, setup the WP_Query
        $tax_query[] = array(
            'taxonomy'  => $taxonomy,
            'field'     => 'id',
            'terms'     => array(
                // For now it's single, it'll be multiple per filter later
                $filter
            )
        );
    }

    $query->set('tax_query', $tax_query);
}

add_action('pre_get_posts', 'sgf_filter_post_types');
