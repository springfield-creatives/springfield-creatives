<?php
// Rewrite author slug
function change_author_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->author_base = 'member';
    $wp_rewrite->author_structure = '/' . $wp_rewrite->author_base. '/%author%';
}
add_action('init','change_author_permalinks');