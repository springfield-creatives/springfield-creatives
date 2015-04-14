<?php

// replace profile menu item
/**
 * Add the "My Account" item.
 *
 * @since 3.3.0
 *
 * @param WP_Admin_Bar $wp_admin_bar
 */
function sc_custom_wp_admin_bar_my_account_item( $wp_admin_bar ) {
    $user_id      = get_current_user_id();
    $current_user = wp_get_current_user();
    $profile_url  = get_author_posts_url( $user_id );

    if ( ! $user_id )
        return;

    $avatar = get_avatar( $user_id, 26 );
    $howdy  = $current_user->user_firstname;
    $class  = empty( $avatar ) ? '' : 'with-avatar';

    $wp_admin_bar->add_menu( array(
        'id'        => 'my-account',
        'parent'    => 'top-secondary',
        'title'     => $howdy . $avatar,
        'href'      => $profile_url,
        'meta'      => array(
            'class'     => $class,
            'title'     => __('My Account'),
        ),
    ) );
}

function sc_custom_admin_bar_init(){
    remove_action( 'admin_bar_menu', 'wp_admin_bar_my_account_item', 7 );
    add_action( 'admin_bar_menu', 'sc_custom_wp_admin_bar_my_account_item', 7 );
}
add_action( 'admin_init', 'sc_custom_admin_bar_init', 100);

function sc_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('wpseo-menu');
    $wp_admin_bar->remove_menu('tribe-events');
    $wp_admin_bar->remove_menu('comments');

    //hide admin bar secondary menu outside of /wp-admin
    if(!is_admin())
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
