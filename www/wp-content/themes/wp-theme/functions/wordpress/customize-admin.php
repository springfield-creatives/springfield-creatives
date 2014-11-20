<?php

// Enqueue Admin JS

// Enqueue custom CSS
function forty_admin_stuff() {
    wp_enqueue_style('forty-admin-css', get_template_directory_uri() . '/style-admin.css');
    wp_enqueue_script( 'forty-admin-js', get_template_directory_uri() . '/assets/scripts/admin.js', array(), '1.0.0', false );
}
add_action('admin_enqueue_scripts', 'forty_admin_stuff');