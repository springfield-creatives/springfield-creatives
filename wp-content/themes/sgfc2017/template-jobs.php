<?php
/*
Template Name: Jobs Board
 */

get_header();
the_post();

require('partial-hero.php');
?>
<section>
  <article>
    <h3 class="margin text-center">Post A Job</h3>
    <div class="grid grid-center">
      <div class="unit-2-3 unit-1-1-md text-center">
        <p class="callout"><?php the_field('post_a_job_blurb') ?></p>
        <p><a class="button" href="<?php the_field('post_a_job_url', 'options') ?>">Add Job</a></p>
      </div>
    </div>
  </article>
</section>

<?php

$featured_jobs = array();
$regular_jobs = array();

$job_query = new WP_Query(array(
  'post_type' => 'jobs',
  'posts_per_page' => -1,
  'orderby' => 'menu_order',
  'order' => 'ASC'
));
while($job_query->have_posts()): $job_query->the_post();

  $post_type = get_field('post_type');
  $business = get_field('company');

  if(is_string($business))
    $business = get_post($business);

  $job_data = array(
    'title' => get_the_title(),
    'url' => get_the_permalink(),
    'apply' => get_field('apply_link'),
    'short_desc' => get_field('short_description'),
    'image' => get_field('logo', $business->ID)['url'],
    'business' => $business->post_title,
    'business_link' => get_the_permalink($business->ID),
    'business_website' => get_field('website_url', $business->ID)
  );

  if($post_type == 'featured')
    $featured_jobs[] = $job_data;
  else
    $regular_jobs[] = $job_data;

endwhile;

wp_reset_query();

foreach($featured_jobs as $job):
  ?>
  <section class="alt thin margin-half">
    <article>
      <div class="grid">
        <div class="unit-1-4 unit-1-1-sm">
          <p><a href="<?php echo $job['url'] ?>"><img class="full rounded" src="<?php echo $job['image'] ?>" /></a></p>
        </div>
        <div class="unit-3-4 unit-1-1-sm">
          <h2><a href="<?php echo $job['url'] ?>"><?php echo $job['title'] ?></h2>
          <h3 class="clean"><?php echo $job['business'] ?></h3>
          <p><a target="_blank" href="<?php echo $job['business_website'] ?>"><?php echo sgfc_get_simple_url( $job['business_website'] ) ?></a> | <a href="<?php echo $job['business_link'] ?>">View Profile</a></p>
          <p><?php echo $job['short_desc'] ?></p>
          <p><a class="button" href="<?php echo $job['apply'] ?>">Apply</a> <a class="button" href="<?php echo $job['url'] ?>">Learn More</a> </p>
        </div>
      </div>
    </article>
  </section>
  <?php
endforeach;
?>

<section>
    <article>
      <div class="grid small">

        <?php
        foreach($regular_jobs as $job):
          ?>
          <div class="unit-1-3 unit-1-2-md unit-1-1-sm margin">
            <div class="grid">
              <div class="unit-1-3">
                <p><a href="<?php echo $job['url'] ?>"><img class="full rounded" src="<?php echo $job['image'] ?>" /></a></p>
              </div>
              <div class="unit-2-3">
                <h4><a href="<?php echo $job['url'] ?>"><?php echo $job['title'] ?></a></h4>
                <p class="clean"><?php echo $job['business'] ?></p>
                <p><a target="_blank" href="<?php echo $job['business_website'] ?>"><?php echo sgfc_get_simple_url( $job['business_website'] ) ?></a> | <a href="<?php echo $job['business_link'] ?>">View Profile</a><br /><a href="<?php echo $job['url'] ?>">Learn More</a></p>
              </div>
            </div>
          </div>
          <?php
        endforeach;
        ?>

      </div>
    </article>
  </section>

  <?php
  get_footer();