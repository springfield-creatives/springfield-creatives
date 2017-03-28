<?php

/**
 * Returns thumbnail image for a given post
 * @param  Integer $post_id
 * @param  String $post_type
 * @param  String|Integer $size
 */

function get_object_image_src($post_id, $post_type = false, $size = 'square-medium'){

  // get post type if not supplied
  if(!$post_type)
    $post_type = get_post_type($post_id);

  if($post_type == 'user'){
    // change size default
    if(!is_integer($size))
      $size = 300;

    // user photo
    return get_wp_user_avatar_src( $post_id, $size, null );

  }else if($post_type == 'jobs'){

    // get connected business/organization and use that
    return get_object_image_src(get_field('company', $post_id, false, $size));

  }else if($post_type == 'organizations' || $post_type == 'businesses'){

    // get connected business/organization and use that
    $post_image = get_field( 'logo', $post_id );
    if(!empty($post_image))
      return $post_image['sizes'][$size];

  }else{

    // everything else
    
    // check if there's a featured image
    if(has_post_thumbnail($post_id)){
      $featured_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
      return is_array($featured_src) ? $featured_src[0] : $featured_src;
    }
    
    // try hero image
    $hero_image = get_field( 'hero_image' );
    if( !empty($hero_image) )
      return $hero_image['sizes'][$size];

  }


  // return default image
  $default = get_field( 'default_' . $post_type . '_image', 'option');
  return $default['sizes'][$size];

}

/**
 * Get an array for use in contact links
 * @param  Integer $id    Post or author id
 * @param  string $type 
 * @param  Array $meta    Meta values if already loaded
 * @return Array
 */
function get_contact_links_arr($id, $is_user = false, $meta){

  $contact_links = array();

  // if meta wasn't passed in, load it now.
  if(empty($meta)){
    if($is_user){
      $post_id =  "user_" . $id;
      $userdata = get_userdata($id);
    }else{
      $post_id = $id;
    }

    $meta = array(
      'phone_number' => get_field('phone_number', $post_id),
      'website_url' => get_field('website_url', $post_id),
      'email' => $type == "user" ? $userdata->user_email : get_field('email', $post_id),
      'address_one' => get_field('address_one', $post_id),
      'address_two' => get_field('address_two', $post_id),
      'city' => get_field('city', $post_id),
      'state' => get_field('state', $post_id),
      'zip' => get_field('zip', $post_id)
    );
  }

  // email
  $contact_links['email'] = array(
    'title' => $meta['email'],
    'url' => 'mailto:' . $meta['email']
  );

  // website
  if(!empty($meta['website_url'])){
    $contact_links['website'] = array(
      'title' => str_replace('http://', '', $meta['website_url']), // no http://
      'url' => $meta['website_url']
    );
  }

  // phone
  if(!empty($meta['phone_number'])){
    $contact_links['phone'] = array(
      'title' => $meta['phone_number'],
      'url' => 'tel:' . preg_replace('/\D+/', '', $meta['phone_number']) // just numbers
    );
  }

  // address
  if(!empty($meta['address_one'])){
    
    $lines = array($meta['address_one']);
    
    if(!empty($meta['address_two']))
      $lines[] = $meta['address_two'];

    $lines[] = $meta['city'] . ' ' . $meta['state'] . ' ' . $meta['zip'];

    $contact_links['address'] = array(
      'title' => implode('<br />', $lines),
      'url' => 'https://www.google.com/maps/place/' . urlencode(implode(', ', $lines))
    );
  }

  return $contact_links;
  
}




/**
 * Get an array for use in social links
 * @param  Integer $id    Post or author id
 * @param  string $type 
 * @param  Array $meta    Meta values if already loaded
 * @return Array
 */
function get_social_links_arr($id, $is_user = false, $meta){

  $social_links = array();

  $field_keys = array(
    'facebook_url' => array(
      'key' => 'facebook',
      'nice_name' => 'Facebook'
    ),
    'twitter_url' => array(
      'key' => 'twitter',
      'nice_name' => 'Twitter'
    ),
    'linkedin_url' => array(
      'key' => 'linkedin',
      'nice_name' => 'LinkedIn'
    ),
    'instagram_url' => array(
      'key' => 'instagram',
      'nice_name' => 'Instagram'
    ),
    'google_plus_url' => array(
      'key' => 'google',
      'nice_name' => 'Google+'
    ),
    'dribbble_url' => array(
      'key' => 'dribbble',
      'nice_name' => 'Dribbble'
    ),
    'youtube_url' => array(
      'key' => 'youtube',
      'nice_name' => 'Youtube'
    ),
    'tumblr_url' => array(
      'key' => 'tumblr',
      'nice_name' => 'Tumblr'
    ),
    'vimeo_url' => array(
      'key' => 'vimeo',
      'nice_name' => 'Vimeo'
    ),
    'soundcloud_url' => array(
      'key' => 'soundcloud',
      'nice_name' => 'SoundCloud'
    ),
  );

  if(empty($meta)){

    $meta = array();
    $post_id = $is_user ? 'user_' . $id : $id;

    foreach($field_keys as $meta_key => $data){
      $meta[$meta_key] = get_field($meta_key, $post_id);
    }

  }

  foreach($field_keys as $meta_key => $data){
    if(!empty($meta[$meta_key]))
      $social_links[$data['key']] = array(
        'url' => $meta[$meta_key],
        'title' => $data['nice_name']
      );
  }

  return $social_links;

}

/**
 * Get an array for use in portfolio
 * @param  Integer $id    Post or author id
 * @param  string $type 
 * @return Array
 */
function get_gallery_arr($id, $is_user = false){

  $media = array();
  
  $post_id = $is_user ? 'user_' . $id : $id;

  $media_rows = get_field('media_gallery', $post_id); 

  if(empty($media_rows))
    return $media;

  foreach($media_rows as $row){

    if($row['media_type'] == 'image'){

      $image = $row['image_src'];

      if(isset($image['sizes']['square-medium']))
        $thumb = $image['sizes']['square-medium'];
      else
        $thumb = $image['url'];

      $src = $image['url'];

    }else{

      $src = $row['video_url'];
      if(!empty($row['thumbnail'])){

        // they provided a video thumb
        if(isset($row['thumbnail']['sizes']['square-medium']))
          $thumb = $row['thumbnail']['sizes']['square-medium'];
        else
          $thumb = $row['url'];

      }else{
        $thumb = get_field('default_video_thumbnail', 'option');
      }

    }

    $media[] = array(
      'type' => $row['type'],
      'title' => $row['title'],
      'thumb' => $thumb,
      'src' => $src,
    );

  }

  return $media;
}



/*
$user: $user array returned by WP or ACF
$subtitle: override subtitle default of company
*/

function return_person_item_html($user){

  if(empty($user))
    return false;

  // convert array to object
  if(is_array($user)){
    $user_object = new stdClass();

    foreach ($user as $key => $value){
        $user_object->$key = $value;
    }
    $user = $user_object;
  }

  // get user link
  $link = get_author_posts_url( $user->ID );

  $name = $user->display_name;
  if (!empty($user->user_firstname) && !empty($user->user_lastname))
      $name = ucwords($user->user_firstname . ' ' . $user->user_lastname);

  $email = $user->user_email;

  $user_image = get_avatar_url( $user->ID, array(
    'size' => 300
  ));

  $positions_arr = array();
  $position_data = get_field('position_at_company', 'user_' . $user->ID);
  if($position_data != false){
    
    if(!is_array($position_data))
      $position_data = array($position_data);

    foreach($position_data as $pos)
      $positions_arr[] = $pos->name;

  }

  $positions = implode(', ', $positions_arr);

  $businesses_arr = array();
  $business_data = get_field('company', 'user_' . $user->ID);
  if($business_data != false){
    
    if(!is_array($business_data))
      $business_data = array($business_data);

    foreach($business_data as $biz)
      $businesses_arr[] = '<a href="' . get_permalink($biz->ID) . '">'  . $biz->post_title . '</a>';

  }

  $businesses = implode(', ', $businesses_arr);

  ob_start();
  ?>
  <div class="unit-1-3 unit-1-2-md unit-1-1-sm margin">
    <div class="grid">
      <div class="unit-1-3">
        <p><img class="full rounded" src="<?php echo $user_image ?>" /></p>
      </div>
      <div class="unit-2-3">
        <h4><?php echo $name ?></h4>
        <p><?php echo $positions ?><br /><i><?php echo $businesses ?></i><br /><a href="<?php echo $link ?>">View Profile</a> | <a href="mailto:<?php echo $email ?>">Email</a></p>
      </div>
    </div>
  </div>
  <?php

  $to_return = ob_get_contents();
  ob_clean();
  return $to_return;
}


/*
$user: $user array returned by WP or ACF
$subtitle: override subtitle default of company
*/
function render_person_item($user){
  echo return_person_item_html($user);
}



function sgfc_get_member_results(){
  global $wpdb;

  $result_data = array(
    'results' => array(),
    'count' => 0,
    'pages' => 0
  );


  // build query
  $wp_query_args = array(
    'post_type' => 'person',
    'posts_per_page' => -1,
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'meta_key' => 'last_name',
    'meta_query' => array(),
    'tax_query' => array()
    );


  // advanced search or dictionary?
  if(!empty($_GET['member_view'])){

    if($_GET['member_view'] !== 'all'){

      // ALPHABETICAL
      $safe_query = $wpdb->prepare( 
        "
        SELECT * FROM $wpdb->users 
        INNER JOIN $wpdb->usermeta
        ON ( $wpdb->users.ID = $wpdb->usermeta.user_id )
        WHERE 1=1
        AND 
        ( 
        ( $wpdb->usermeta.meta_key = 'last_name' AND CAST($wpdb->usermeta.meta_value AS CHAR) LIKE %s )
        )
        -- AND ($wpdb->users.post_status = 'publish') TODO: Make sure they're active
        GROUP BY $wpdb->users.ID
        ORDER BY $wpdb->usermeta.meta_value ASC
        ", 
        $_GET['member_view'] . '%'
      );

      $result_data = array(
        'results' => $wpdb->get_results($safe_query),
        'count' => $wpdb->get_results($safe_query),
        'pages' => 1
      );
    
    }else{

      // SHOW ALL
      // query and pagination
      $number     = 36;
      $paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $offset     = ($paged - 1) * $number;

      $args = array(
          'orderby' => "meta_value",
          'meta_key' => 'last_name',
          "order" => "asc",
          "number" => $number,
          "offset" => $offset,
      );

      // TODO - only show registered
      // $meta_query = array(
      //     'relation' => 'AND',
      //     array(
      //         'key'     => 'wp_capabilities',
      //         'value'   => 'expired',
      //         'compare' => 'NOT LIKE'
      //     )
      // );


      // do the query
      $members = new WP_User_Query($args);

      $result_data['results'] = $members->results;
      $result_data['count'] = $members->total_users;
      $result_data['pages'] = ceil($total_users / $number);
      
    }

  }else{

    // query and pagination
    $number     = 36;
    $paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $offset     = ($paged - 1) * $number;

    $args = array(
      'orderby' => "meta_value",
      'meta_key' => 'last_name',
      "order" => "asc",
      "number" => $number,
      "offset" => $offset,
    );

    // Filter by industry or search boxes?
    if(!empty($_GET['member_industry'])){

      $meta_query = array('relation' => 'OR');

      foreach($_GET['member_industry'] as $industry_id)
        $meta_query[] = array(
          'key' => 'profession',
          'value' => '"' . $industry_id . '"',
          'compare' => 'LIKE'
        );


    }else{

      $meta_query = array('relation' => 'AND');

      // FNAME
      if(!empty($_GET['member_fname'])){
        $meta_query[] = array(
          'key' => 'first_name',
          'value' => $_GET['member_fname']
        );
      }

      // LNAME
      if(!empty($_GET['member_lname'])){
        $meta_query[] = array(
          'key' => 'last_name',
          'value' => $_GET['member_lname']
        );
      }

      // EMPLOYER TODO
      /*
      if(!empty($_GET['member_lname'])){
        $meta_query[] = array(
          'key' => 'last_name',
          'value' => $_GET['member_lname']
        );
      }
      */

      // KEYWORD
      if(!empty($_GET['member_keyword'])){
        $meta_query[] = array(
          'key' => 'about_you',
          'value' => $_GET['member_keyword'],
          'compare' => 'LIKE'
        );
      }

      // COMMITTEE
      if(!empty($_GET['member_committee'])){
        $meta_query[] = array(
          'key' => 'about_you',
          'value' => '"' . $_GET['member_committee'] . '"',
          'compare' => 'LIKE'
        );
      }
      
    }

    $args['meta_query'] = $meta_query;


    // do the query
    $members = new WP_User_Query($args);

    $result_data['results'] = $members->results;
    $result_data['count'] = $members->total_users;
    $result_data['pages'] = ceil($total_users / $number);

  }
  
  return $result_data;
}



function sgfc_get_business_results(){
  $results = array();


  // build query
  $wp_query_args = array(
    'post_type' => 'person',
    'posts_per_page' => -1,
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'meta_key' => 'last_name',
    'meta_query' => array(),
    'tax_query' => array()
    );


  // advanced search or dictionary?
  if(!empty($_GET['dict'])){

    $safe_query = $wpdb->prepare( 
      "
      SELECT * FROM $wpdb->posts 
      INNER JOIN $wpdb->postmeta
      ON ( $wpdb->posts.ID = $wpdb->postmeta.post_id )
      WHERE 1=1
      AND 
      ( 
      ( $wpdb->postmeta.meta_key = 'last_name' AND CAST($wpdb->postmeta.meta_value AS CHAR) LIKE %s )
      )
      AND $wpdb->posts.post_type = 'person'
      AND ($wpdb->posts.post_status = 'publish')
      GROUP BY $wpdb->posts.ID
      ORDER BY $wpdb->postmeta.meta_value ASC
      ", 
      $_GET['dict'] . '%'
      );
    $posts_array = $wpdb->get_results($safe_query);

  }else{

    $query_vars = array(
      'first_name' => !empty($_GET['first_name']) ? $_GET['first_name'] : false,
      'last_name' => !empty($_GET['last_name']) ? $_GET['last_name'] : false,
      'practice' => !empty($_GET['practice-id']) ? $_GET['practice-id'] : false,
      'school' => !empty($_GET['school-id']) ? $_GET['school-id'] : false,
      'location' => !empty($_GET['location-id']) ? $_GET['location-id'] : false,
      'language' => !empty($_GET['language-id']) ? $_GET['language-id'] : false
      );

    $meta_keys = array('first_name', 'last_name');
    $taxonomy_keys = array('practice', 'school', 'location', 'language');


    // meta fields
    foreach($meta_keys as $cur_meta_key):

      if($query_vars[$cur_meta_key] == false)
        continue;

      $wp_query_args['meta_query'][] = array(
        'key' => $cur_meta_key,
        'value' => $query_vars[$cur_meta_key],
        'compare' => 'LIKE'
        );

      endforeach;


    // taxonomies
      foreach($taxonomy_keys as $cur_tax_key):

        if($query_vars[$cur_tax_key] === false)
          continue;

        $wp_query_args['tax_query'][] = array(
          'taxonomy' => $cur_tax_key,
          'field'    => 'term_id',
          'terms'    => $query_vars[$cur_tax_key]
          );

        endforeach;

      }


  return $results;
}



add_filter( 'user_search_columns', 'sc_search_display_name', 10, 3 );
    
function sc_search_display_name( $search_columns, $search, $this ) {
    $search_columns[] = 'display_name';
    return $search_columns;
}