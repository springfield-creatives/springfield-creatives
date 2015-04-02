<?php

function custom_login_logo() {
    echo '<style type="text/css">
    	body { background: #fff }
        h1 a {
        	background-size: 150px !important;
        	width: 150px !important;
        	height: 106px !important;
        	background-image:url(' . get_bloginfo('template_directory') . '/assets/images/logo-2x.png) !important;
        }
    </style>';
}

add_action('login_head', 'custom_login_logo');

function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Springfield Creatives';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

/**
 * Redirect non-admins to the homepage after logging into the site.
 *
 * @since   1.0
 */
function soi_login_redirect( $redirect_to, $request, $user  ) {
    return ( is_array( $user->roles ) && in_array( 'administrator', $user->roles ) ) ? admin_url() : site_url();
} // end soi_login_redirect
// add_filter( 'login_redirect', 'soi_login_redirect', 10, 3 );