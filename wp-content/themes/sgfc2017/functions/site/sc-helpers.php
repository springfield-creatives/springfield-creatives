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

  if($post_type == 'jobs'){

    // get connected business/organization and use that
    return get_object_image_src(get_field('company', $post_id, false, $size));

  }else if($post_type == 'organizations' || $post_type == 'businesses'){


    // get connected business/organization and use that
    $post_image = get_field( 'logo', $post_id );
    if(!empty($post_image) && is_array($post_image))
      return !empty($post_image['sizes'][$size]) ? $post_image['sizes'][$size] : $post_image['url'];

  }else{

    // everything else
    
    // check if there's a featured image
    if(has_post_thumbnail($post_id)){
      return get_the_post_thumbnail_url($post_id, $size);
    }
    
    // try hero image
    $hero_image = get_field( 'hero_image' );
    if( !empty($hero_image) )
      return $hero_image['sizes'][$size];

  }


  // return default image
  // $default = get_field( 'default_' . $post_type . '_image', 'option');
  // return $default['sizes'][$size];
  return get_stylesheet_directory_uri() . '/media/images/agency.svg';;

}

/**
 * Get an array for use in contact links
 * @param  Integer $id    Post or author id
 * @param  string $type 
 * @param  Array $meta    Meta values if already loaded
 * @return Array
 */
function get_contact_links_arr($id, $is_user = false, $meta = array()){

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
function get_social_links_arr($id, $is_user = false, $meta = array()){

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
    'medium_url' => array(
      'key' => 'medium',
      'nice_name' => 'Medium'
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

function get_user_business_data($user_id){
  $positions_arr = array();
  $position_data = get_field('position_at_company', 'user_' . $user_id);
  if($position_data != false){
    
    if(!is_array($position_data))
      $position_data = array($position_data);

    foreach($position_data as $pos)
      $positions_arr[] = $pos->name;

  }

  $positions = implode(', ', $positions_arr);

  $businesses_arr = array();
  $business_data = get_field('company', 'user_' . $user_id);
  if($business_data != false){
    
    if(!is_array($business_data))
      $business_data = array($business_data);

    foreach($business_data as $biz)
      $businesses_arr[] = '<a href="' . get_permalink($biz->ID) . '">'  . $biz->post_title . '</a>';

  }

  $businesses = implode(', ', $businesses_arr);

  return array(
    'positions' => $positions,
    'businesses' => $businesses
  );

}


function sgfc_prep_user_data($user){
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

  $user_image = sgfc_get_user_avatar( $user->ID, '300');

  $user_business_data = get_user_business_data($user->ID);
  $positions = $user_business_data['positions'];
  $businesses = $user_business_data['businesses'];

  $start_date = date('F Y', strtotime($user->user_registered));

  // default subtitle
  ob_start();
  if(empty($positions) && empty($businesses)){

    echo '<i>Member Since<br>';
    echo $start_date . '</i><br/>';

  }else{

    if(!empty($positions))
      echo $positions;

    echo '<br />';


    if(!empty($businesses))
      echo '<i>' . $businesses . '</i>';

    echo '<br />';

  }
  $subtitle = ob_get_contents();
  ob_clean();

  return array(
    'user' => $user,
    'link' => $link,
    'name' => $name,
    'email' => $email,
    'image' => $user_image,
    'business_data' => $user_business_data,
    'positions' => $positions,
    'businesses' => $businesses,
    'start_date' => $start_date,
    'subtitle' => $subtitle
  );
}



/*
$user: $user array returned by WP or ACF
$subtitle: override subtitle default of company
*/

function return_person_item_html($user, $subtitle = ''){

  if(empty($user))
    return false;

  $user_data = sgfc_prep_user_data($user);

  ob_start();
  ?>
  <div class="unit-1-3 unit-1-2-md unit-1-1-sm margin">
    <div class="grid">
      <div class="unit-1-3">
        <p><a href="<?php echo $user_data['link'] ?>"><img class="full rounded" src="<?php echo $user_data['image'] ?>" /></a></p>
      </div>
      <div class="unit-2-3">
        <h4><a href="<?php echo $user_data['link'] ?>"><?php echo $user_data['name'] ?></a></h4>
        <p>
          <?php
          if(empty($subtitle))
            echo $user_data['subtitle'];
          else
            echo $subtitle;
          ?>
          <a href="<?php echo $user_data['link'] ?>">View Profile</a> | <a href="mailto:<?php echo $user_data['email'] ?>">Email</a>
        </p>
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

function _flatten_array($array) {
    if (!is_array($array)) {
        // nothing to do if it's not an array
        return array($array);
    }

    $result = array();
    foreach ($array as $value) {
        // explode the sub-array, and add the parts
        $result = array_merge($result, flatten($value));
    }

    return $result;
}


function _sgfc_get_inactive_membership_user_ids(){
  
  global $wpdb;

  $safe_query = 
    "
    SELECT wp_users.ID
    FROM wp_users
      INNER JOIN wp_posts
        ON ( wp_users.ID = wp_posts.post_author )
    WHERE 1=1
    AND 
    ( 
      ( wp_posts.post_type = 'wc_user_membership' AND wp_posts.post_status != 'wcm-active' )
    )
    GROUP BY wp_users.ID
    ORDER BY wp_usermeta.meta_value ASC
    ";

  $member_query = $wpdb->get_results($safe_query, ARRAY_N);

  return _flatten_array($member_query);
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

      // Alphabetical listing

      $safe_query = $wpdb->prepare( 
        "
        SELECT $wpdb->users.*, $wpdb->usermeta.*
        FROM $wpdb->users
          INNER JOIN $wpdb->usermeta
            ON ( $wpdb->users.ID = $wpdb->usermeta.user_id )
          INNER JOIN $wpdb->posts
            ON ( $wpdb->users.ID = $wpdb->posts.post_author )
        WHERE 1=1
        AND 
        ( 
          ( $wpdb->usermeta.meta_key = 'last_name' AND CAST($wpdb->usermeta.meta_value AS CHAR) LIKE %s )
          AND
          ( $wpdb->posts.post_type = 'wc_user_membership' AND $wpdb->posts.post_status = 'wcm-active' )
        )
        GROUP BY $wpdb->users.ID
        ORDER BY $wpdb->usermeta.meta_value ASC
        ", 
        $_GET['member_view'] . '%'
      );

      $member_query = $wpdb->get_results($safe_query); 
      $result_data = array(
        'results' => $member_query,
        'count' => $member_query->num_rows,
        'pages' => 1
      );
    
    }else{

      // SHOW ALL
      // query and pagination
      $number     = 36;
      $paged      = !empty(get_query_var('paged')) ? get_query_var('paged') : 1;
      $offset     = ($paged - 1) * $number;

      $args = array(
          'orderby' => "meta_value",
          'meta_key' => 'last_name',
          "order" => "asc",
          "number" => $number,
          "offset" => $offset,
      );

      // TODO - only show registered
      $meta_query = array(
          'relation' => 'AND',
          array(
              'key'     => 'wp_capabilities',
              'value'   => 'expired',
              'compare' => 'NOT LIKE'
          )
      );


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
      'active_members' => true,
      'orderby' => "meta_value",
      'meta_key' => 'last_name',
      "order" => "asc",
      "number" => $number,
      "offset" => $offset,
    );

    // Filter by industry or search boxes?
    if(!empty($_GET['member_industry'])){

      $meta_query = array('relation' => 'AND');

      foreach($_GET['member_industry'] as $industry_id)
        $meta_query[] = array(
          'key' => 'skills',
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

      // Availability
      if(!empty($_GET['member_availability'])){
        $meta_query[] = array(
          'key' => 'availability',
          'value' => '"' . $_GET['member_availability'] . '"',
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

    $members = new WP_User_Query($args);

    $result_data['results'] = $members->results;
    $result_data['count'] = $members->total_users;
    $result_data['pages'] = ceil($members->total_users / $number);


  }

  wp_reset_query();
  
  return $result_data;
}


// filter all user query to only contain active members
// Use query var "active_members" = true
function sgfc_add_active_members_filter( $user_query ) {

  global $wpdb;

  if(!$user_query->get("active_members"))
    return;

  $user_query->query_from .= ' INNER JOIN ' . $wpdb->posts . ' ON ' . $wpdb->posts . '.post_author = ' . $wpdb->users . '.ID '; // additional joins here
  $user_query->query_where .= ' AND ' . $wpdb->posts . '.post_status = "wcm-active"'; // additional where clauses

}
add_action( 'pre_user_query', 'sgfc_add_active_members_filter' );



function sgfc_get_business_results($type = 'businesses'){
  global $post, $wpdb;

  $meta_query = array();

  $result_data = array(
    'results_featured' => array(),
    'results_reg' => array(),
    'count' => 0,
    'pages' => 1
  );


  // build query
  $wp_query_args = array(
    'post_type' => $type,
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'meta_query' => array()
  );


  if(!empty($_GET['business_view']) && $_GET['business_view'] !== 'all'){

    // BY ALPHABET
    $safe_query = $wpdb->prepare( 
      "
      SELECT *, $wpdb->postmeta.meta_value as sponsor FROM $wpdb->posts 
      INNER JOIN $wpdb->postmeta
      ON ( $wpdb->posts.ID = $wpdb->postmeta.post_id )
      WHERE 1=1
      AND 
      ( 
      ( CAST(post_title AS CHAR) LIKE %s )
      )
      AND $wpdb->posts.post_type = %s
      AND ($wpdb->posts.post_status = 'publish')
      AND ($wpdb->postmeta.meta_key = 'is_sponsor')
      GROUP BY $wpdb->postmeta.meta_value DESC
      ORDER BY $wpdb->posts.post_title ASC
      ", 
      $_GET['business_view'] . '%',
      $type
    );

    $posts_array = $wpdb->get_results($safe_query);

    // sort into featured and non
    foreach($posts_array as $post){
      if($post->sponsor && intval(get_field('sponsor_level', $post->ID)) >= 3)
        $result_data['results_featured'][] = $post;
      else
        $result_data['results_reg'][] = $post;
    }

    $result_data['count'] = count($posts_array);
    $result_data['pages'] = 1;

    return $result_data;

  }else{


    if(!empty($_GET['business_industry'])){


      $wp_query_args['tax_query'] = array(
          array(
            'taxonomy' => 'industry',
            'field'    => 'slug',
            'terms' => $_GET['business_industry']
          )
      );

    }else if(!empty($_GET['business_org_type'])){


      $wp_query_args['tax_query'] = array(
          array(
            'taxonomy' => 'organization-type',
            'field'    => 'term_id',
            'value' => $_GET['business_org_type']
          )
      );

    }else{

      if(!empty($_GET['business_name'])){
        $wp_query_args['title_contains'] = $_GET['business_name'];
      }

      if(!empty($_GET['business_keyword'])){
        $meta_query[] = array(
          'key' => 'about',
          'value' => $_GET['business_keyword'],
          'compare' => 'LIKE'
        );
        $meta_query[] = array(
          'key' => 'short_description',
          'value' => $_GET['business_keyword'],
          'compare' => 'LIKE'
        );
        $meta_query['relation'] = 'OR';
      }

    }

    $wp_query_args['meta_query'] = $meta_query;

    if(!empty($wp_query_args['s']))
      $wp_query_args['s'] = $_GET['business_keyword'];

    $results = new WP_Query($wp_query_args);

    while($results->have_posts()): $results->the_post();
      if(get_field('is_sponsor') && intval( get_field('sponsor_level') ) >= 3)
        $result_data['results_featured'][] = $post;
      else
        $result_data['results_reg'][] = $post;
    endwhile;

    wp_reset_query();

    $result_data['count'] = $results->found_posts;
    $result_data['pages'] = $results->max_num_pages;

  }


  return $result_data;
}


add_filter( 'posts_where', 'sc_title_wp_query_filter', 10, 2 );
function sc_title_wp_query_filter($where, &$wp_query){
    global $wpdb;
    
    $search_term = $wp_query->get( 'title_contains' );

    if(!empty($search_term)){
      $search_term = $wpdb->esc_like($search_term);
      $search_term = ' \'%' . $search_term . '%\'';
      $where .= ' AND ' . $wpdb->posts . '.post_title LIKE '.$search_term;
    }

    return $where;
}


add_filter( 'user_search_columns', 'sc_search_display_name', 10, 3 );
    
function sc_search_display_name( $search_columns, $search, $this ) {
    $search_columns[] = 'display_name';
    return $search_columns;
}

function sgfc_is_sponsor($post){

  // check the manually-added property
  if(isset($post->sponsor))
    return boolval($post->sponsor);

  return get_field('is_sponsor', $post->ID);
}


/*
Returns HTML for a post item that is either business, or organization
$post: $post object returned by WP or ACF. Defaults to current $post
$subtitle: override subtitle default for that post type
*/

function return_directory_item_html($post_object = false, $is_featured = false, $is_sponsor = false){
  global $post;

  if($post_object === false)
    $post_object = $post;

  if($post_object->post_type == 'businesses')
    $tax = 'industry';
  else if($post_object->post_type == 'organizations')
    $tax = 'organization-type';

  $terms = get_the_terms( $post->ID, $tax );
  if ( $terms && ! is_wp_error( $terms ) ) {
    $subtitles = array();
      foreach ( $terms as $term ) {
      $subtitles[] = $term->name;
    }
    $subtitle = join( ", ", $subtitles );
  } else {
    $subtitle = false;
  }

  $name = $post_object->post_title;

  $website = get_field('website_url', $post_object->ID);

  $short_desc = get_field('short_description', $post_object->ID);

  $email = get_field('email', $post_object->ID);

  $link = get_permalink($post_object->ID);

  $post_image_src = get_object_image_src($post_object->ID, $post_object->post_type, 'medium');

  ob_start();

  if($is_featured){
    

    // FEATURED
    // 
    ?>

    <div class="unit-1-5 unit-1-2-sm unit-1-3-mb unit-center">
      <a href="<?php echo $link ?>"><div class="circle border margin-half"><span><img src="<?php echo $post_image_src ?>" /></span></div></a>
    </div>
    <div class="unit-4-5 unit-1-2-sm unit-2-3-mb unit-center">
      <h2><a href="<?php echo $link ?>"><?php echo $name ?></a></h2>

      <?php
      if(!empty($subtitle))
        echo '<h3>' . $subtitle . '</h3>';
      ?>
      
      <p>
        <?php
        if(!empty($website)){
          $simple_url = sgfc_get_simple_url($website);
          echo '<a href="' . $website . '">' . $simple_url . '</a><br />';
        }
        ?>
        
        <a href="<?php echo $link ?>">View Profile</a>
        
        <?php
        if(!empty($email))
          echo ' | <a href="mailto:' . $email . '">Email</a>';
        ?>
      </p>
    </div>
    <div class="unit-4-5 unit-1-1-sm unit-center grid-cell-right">
      <?php
      if(!empty($short_desc))
        echo '<p>' . $short_desc . '</p>';
      ?>
    </div>

    <?php
  }else{


    // REGULAR
    // 
    ?>

    <div class="unit-1-2 unit-1-1-sm margin">
      <div class="grid">
        <div class="unit-1-3 unit-center">
          <a href="<?php echo $link ?>"><div class="circle border margin-half"><span><img src="<?php echo $post_image_src ?>" /></span></div></a>
        </div>
        <div class="unit-2-3 unit-center">
          
          <h4><a href="<?php echo $link ?>">
            <?php
            if($is_sponsor)
              echo '<i class="fa fa-star"></i> ';
            ?>
            <?php echo $name ?>
          </a></h4>
          

          <p>
            <?php
            if(!empty($subtitle))
              echo $subtitle . '<br />';
            ?>
            
            <a href="<?php echo $link ?>">View Profile</a>
            
            <?php
            if(!empty($email))
              echo ' | <a href="mailto:' . $email . '">Email</a>';
            ?>
          </p>

        </div>
      </div>
    </div>

    <?php
  }

  $to_return = ob_get_contents();
  ob_clean();
  return $to_return;
}

function sgfc_get_simple_url($website){
  $simple_url = str_replace('http://', '', $website);
  $simple_url = str_replace('https://', '', $simple_url);

  return $simple_url;
}


/*
$post: $post array returned by WP or ACF
$subtitle: override subtitle default of company
*/
function render_directory_item($post = false, $is_featured = false, $is_sponsor = false){
  echo return_directory_item_html($post, $is_featured, $is_sponsor);
}



function sgfc_has_editor_permission($post_id, $user_id = false){

  if(!$user_id){
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;
  }

  $author = get_the_author_meta('ID', $user_id);
  $editors = get_field('editors', $post_id);

  if($author == $user_id)
    return true;

  if(in_array($user_id, $editors))
    return true;

  return false;

}


function sgfc_get_editable_posts($user_id, $post_type, $action_post_name){
  $posts = array();

  // by author
  $user_jobs_author = new WP_Query(array(
    'post_type' => $post_type,
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'author' => $user_id
  ));
  while($user_jobs_author->have_posts()): $user_jobs_author->the_post();
    $posts[get_the_ID()] = array(
      'id' => get_the_ID(),
      'title' => get_the_title()
    );
  endwhile;

  wp_reset_query();

  // by ACF
  $user_jobs_acf = new WP_Query(array(
    'post_type' => $post_type,
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'meta_query' => array(
      array(
        'key' => 'editors',
        'value' => '"' . $user_id . '"',
        'compare' => 'LIKE'
      )
    )
  ));
  while($user_jobs_acf->have_posts()): $user_jobs_acf->the_post();
    $posts[get_the_ID()] = array(
      'id' => get_the_ID(),
      'title' => get_the_title()
    );
  endwhile;

  wp_reset_query();

  // sort
  function sgfc_sort_these_posts(){
    if ($a['title'] == $b['title']) {
        return 0;
    }
    return ($a['title'] < $b['title']) ? -1 : 1;
  }

  usort($posts, "sgfc_sort_these_posts");

  echo '<h2>' . $action_post_name . '</h2>';
  echo '<ul>';
  
  foreach($posts as $cur_post)
    echo '<li><a href="?entry-id=' . $cur_post['id'] . '">' . $cur_post['title'] . '</a></li>';

  echo '</ul>';
}


function sgfc_get_user_avatar($user_id, $size){
  // try manual avatar
  if(has_wp_user_avatar($user_id))
    return get_wp_user_avatar_src($user_id, $size);

  // try gravatar/wp default
  // $wp_avatar = get_avatar_url($user_id, array( 'size' => 300 ));
  // if(!empty($wp_avatar))
  //   return $wp_avatar;

  // if we still have nothing, use the default as configured in the avatar plugin
  return get_wp_user_avatar_src($user_id, $size);

}


function sgfc_get_perks(){
  
  $perks = array();

  $perks_q = new WP_Query(array(
    'post_type' => array('organizations', 'businesses'),
    'meta_query' => array(
      array(
        'key'     => 'perks',
        'value'   => '',
        'compare' => '!=',
      )
    ),
  ));

  while($perks_q->have_posts()){
    $perks_q->the_post();
    $the_link = 
    $post_image_src = 
    $perks[] = array(
      'link' => get_the_permalink(),
      'title' => get_the_title(),
      'logo' => get_object_image_src(get_the_ID(), get_post_type()),
      'perks' => get_field('perks')
    );
  }
  return $perks;

}

function sgfc_get_perks_shortcode(){
  $perks = sgfc_get_perks();

  ob_start();
  ?>

  <div class="grid small">
    <?php
    foreach($perks as $perk):
      ?>
      <div class="unit-1-2 unit-1-1-sm margin">
        <div class="grid">
          <div class="unit-1-3">
            <a href="<?php echo $perk['link'] ?>"><div class="circle border margin-half"><span><img src="<?php echo $perk['logo'] ?>" /></span></div></a>
          </div>
          <div class="unit-2-3">
            <h4><?php echo $perk['title'] ?></h4>
            <p><?php echo $perk['perks'] ?></p>
          </div>
        </div>
      </div>
      <?php
    endforeach;
    ?>
  </div>

  <?php
  $html = ob_get_contents();
  ob_clean();

  return $html;
}
add_shortcode('sgfc-perks', 'sgfc_get_perks_shortcode');