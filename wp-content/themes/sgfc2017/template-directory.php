<?php
/*
Template Name: Directory Landing
 */

get_header();
the_post();

require('partial-hero.php');
?>
<section >
  <article>
    <div class="grid grid-center">
      <div class="unit-1-3 unit-1-1-sm margin text-center">
        <p><a href="<?php the_field('membership_directory_url', 'options') ?>"><img class="full" src="<?php echo get_stylesheet_directory_uri() ?>/media/images/pro.svg" height="225" /></a></p>
        <h3><a href="<?php the_field('membership_directory_url', 'options') ?>">Member Directory</a></h3>
        <p><?php the_field('membership_dir_desc') ?></p>
      </div>
      <div class="unit-1-3 unit-1-1-sm margin text-center">
        <p><a href="<?php the_field('business_directory_url', 'options') ?>"><img class="full" src="<?php echo get_stylesheet_directory_uri() ?>/media/images/agency.svg" height="225" /></a></p>
        <h3><a href="<?php the_field('business_directory_url', 'options') ?>">Business Directory</a></h3>
        <p><?php the_field('business_dir_desc') ?></p>
      </div>
      <div class="unit-1-3 unit-1-1-sm margin text-center">
        <p><a href="<?php the_field('organization_directory_url', 'options') ?>"><img class="full" src="<?php echo get_stylesheet_directory_uri() ?>/media/images/outreach.svg" height="225" /></a></p>
        <h3><a href="<?php the_field('organization_directory_url', 'options') ?>">Organization Directory</a></h3>
        <p><?php the_field('organization_dir_desc') ?></p>
      </div>
    </div>
  </article>
</section>

<?php
get_footer();