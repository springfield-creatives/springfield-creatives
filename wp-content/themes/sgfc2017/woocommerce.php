<?php
get_header();

?>
<section class="hero overlay" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/media/images/hero.jpg);">
  <article>
    <h1><?php the_title() ?></h1>
  </article>
</section>
<section>
  <article>
    <?php woocommerce_content(); ?>
  </article>
</section>
<?php
get_footer();
?>