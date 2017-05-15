<?php
get_header();
the_post();

$hero_intro = get_the_date() . ' | ' . get_the_author();

require('partial-hero.php');

?>
<section>
  <article>
    <div class="grid">
      <div class="unit-3-4 unit-1-1-md margin">
        <?php the_content() ?>
      </div>
      <div class="unit-1-4 unit-1-1-md">
        <?php require('partial-blog-sidebar.php'); ?>
      </div>
    </div>  
  </article>
</section>
<?php
get_footer();
?>