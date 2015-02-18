<?php
get_header();

$hero_page_option_prefix = $wp_query->query['post_type'] . '_directory';

include('partials/hero.php');

include('partials/directory-list.php');

get_footer();