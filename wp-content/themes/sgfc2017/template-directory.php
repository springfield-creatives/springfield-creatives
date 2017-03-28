<?php
/*
Template Name: Directory Landing
 */

get_header();
the_post()
?>

<section class="hero overlay" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/media/images/hero.jpg);">
  <article>
    <h1 class="margin text-center">Springfield Creatives Directory</h1>
    <div class="grid grid-center">
      <div class="unit-2-3 unit-1-1-md text-center">
        <p><?php the_field('intro') ?></p>
      </div>
    </div>
  </article>
</section>
<section >
  <article>
    <div class="grid grid-center">
      <div class="unit-1-3 unit-1-1-sm margin text-center">
        <p><a href="<?php the_field('membership_directory_url', 'options') ?>"><img class="full" src="media/images/business.svg" height="225" /></a></p>
        <h3><a href="<?php the_field('membership_directory_url', 'options') ?>">Member Directory</a></h3>
        <p><?php the_field('membership_dir_desc') ?></p>
      </div>
      <div class="unit-1-3 unit-1-1-sm margin text-center">
        <p><a href="<?php the_field('business_directory_url', 'options') ?>"><img class="full" src="media/images/find.svg" height="225" /></a></p>
        <h3><a href="<?php the_field('business_directory_url', 'options') ?>">Business Directory</a></h3>
        <p><?php the_field('business_dir_desc') ?></p>
      </div>
    </div>
  </article>
</section>

<?php
get_footer();