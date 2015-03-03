<?php

function sgf_filter_post_types ($query) {

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