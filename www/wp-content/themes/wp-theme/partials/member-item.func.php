<?php

/*
    @param WP_User $member Object from the WP_User_Query result list
    @param String $subtitle override subtitle default of company
    @return void
*/

function render_member_item ($user, $subtitle = false) {

    if (empty($user))
        return false;

    // get user link
    $link = get_author_posts_url( $user->ID );

    // default subtitle to company
    if (!$subtitle) {
        // get connected businesses posts
        $connected = get_posts( array(
            'connected_type' => 'businesses_user',
            'connected_items' => $user,
            'suppress_filters' => false,
            'nopaging' => true
        ) );

        // set the subtitle accordingly
        // TODO: list all businesses if there are multiple
        if (!empty($connected)) {
            $subtitle = '<a href="' . get_permalink($connected[0]->ID) . '">' . $connected[0]->post_title . '</a>';
        } else {
            // get manual text meta and use that, no link
            $subtitle = get_field( 'business', 'user_' . $user->ID );
        }
    }

    $name = $user->display_name;
    if (!empty($user->user_firstname) && !empty($user->user_lastname))
        $name = $user->user_firstname . ' ' . $user->user_lastname;

    $user_image = get_field( 'photo', 'user_' . $user->ID );
    $email = $user->user_email;

    // Try gravitar
    if (empty($user_image)) {
        $email_hash = md5(strtolower(trim($email)));
        $url = 'https://www.gravatar.com/' . $email_hash . '.php';

        if ($profile = @file_get_contents($url, false)) {

            $profile = file_get_contents($url);
            $profile = unserialize($profile);

            $user_image = $profile['entry'][0]['thumbnailUrl'] . '?s=300';

        } else {
            // Set default user image w/e that may be
            $user_image = get_field('default_user_image', 'options');
            $user_image = $user_image['sizes']['square-medium'];
        }
    } else {
        $user_image = $user_image['sizes']['square-medium'];
    }


    include ('member-item.php');
}
?>