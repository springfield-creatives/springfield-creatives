<?php

function sc_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wpseo-menu');
    $wp_admin_bar->remove_menu('tribe-events');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('top-secondary');

    // for non-admins:
    if(! current_user_can( 'manage_options' ) ) {
        $wp_admin_bar->remove_menu('new-content');
    }
}
add_action( 'wp_before_admin_bar_render', 'sc_admin_bar_render' );

// hide admin bar for non-admins
function remove_admin_bar() {
	if (!current_user_can('publish_posts') && !is_admin()) {
	  show_admin_bar(false);
	}
}
add_action('after_setup_theme', 'remove_admin_bar');
