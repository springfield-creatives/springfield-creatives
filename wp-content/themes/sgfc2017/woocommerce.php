<?php
get_header();

$no_hero = true;
if(is_archive()){

  $hero_title = get_field('hero_text', get_option( 'woocommerce_shop_page_id' ));
  $hero_img = get_field('hero_image', get_option( 'woocommerce_shop_page_id' ));
  $hero_intro = get_field('hero_intro', get_option( 'woocommerce_shop_page_id' ));
  $no_hero = false;

}

if(!$no_hero){
  require('partial-hero.php');
} else {
  ?>
  <div class="hero-buffer"></div>
  <?php
}
?>

<section>
  <article>asdf
    <?php woocommerce_content(); ?>
  </article>
</section>

<?php
get_footer();
?>
