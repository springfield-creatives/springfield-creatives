<?php
/*
Template Name: Post a Job
 */

get_header();
the_post();

?>
<section>
  <article>
    <h2 class="margin text-center">Post A Job</h2>
    <div class="grid grid-center margin-double">
      <div class="unit-2-3 unit-1-1-md text-center">
        <p class="callout"><?php the_field('intro') ?></p>
      </div>
    </div>

    <?php the_content() ?>

  </article>
</section>

<?php
get_footer();