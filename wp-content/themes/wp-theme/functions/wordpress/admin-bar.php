<?php

function sc_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wpseo-menu');
    $wp_admin_bar->remove_menu('tribe-events');
    $wp_admin_bar->remove_menu('comments');

    // for non-admins:
    if(! current_user_can( 'manage_options' ) ) {
        $wp_admin_bar->remove_menu('site-name');
        $wp_admin_bar->remove_menu('new-content');
    }
}
add_action( 'wp_before_admin_bar_render', 'sc_admin_bar_render' );