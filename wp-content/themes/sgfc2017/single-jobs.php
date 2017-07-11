<?php
get_header();
the_post();


$business = get_field('company');
$business_id = is_object($business) ? $business->ID : $business;
$website = get_field('website_url', $business_id);
$image = get_object_image_src($business_id);
$job_type = get_field('job_type');

$apply_link = get_field('apply_link');
if(empty($apply_link))
  $apply_link = $website;

global $fa_icons;
?>

<section>
  <article>
    <div class="grid grid-center">
      <div class="unit-1-2 unit-1-1-md margin">
        <div class="margin-double">
          <a href="<?php bloginfo('url') ?>/jobs-board">← Back to Jobs Board</a>
          <br>
          <br>
          <h1><?php the_title() ?></h1>
          <h3><?php echo $business->post_title ?></h3>
          <p class="callout"><?php echo is_array($job_type) ? $job_type['label'] : $job_type ?></p>
          <p><a href="<?php echo $website ?>"><?php echo sgfc_get_simple_url( $website ) ?></a> | <a href="<?php echo get_the_permalink($business_id) ?>">View Profile</a></p>
          <ul class="social">

            <?php
            if(!empty($profile['social_links'])){
              foreach($profile['social_links'] as $key => $contact_info){
                $class = isset($fa_icons[$key]) ? $fa_icons[$key] : '';
                echo '<li><a href="' . $contact_info['url'] .'"><i class="fa ' . $class . '"></i></a><li>';
              }
            }
            ?>

          </ul>
        </div>
        <?php echo apply_filters('the_content', get_field('full_description')) ?>
        <p><a class="button" target="_blank" href="<?php echo $apply_link ?>">Apply</a></p>
      </div>
      <div class="unit-1-2 unit-1-1-md margin">
        <p class="margin-double"><img src="<?php echo $image ?>" /></p>
      </div>
    </div>
  </article>
</section>

  <?php
  get_footer();
