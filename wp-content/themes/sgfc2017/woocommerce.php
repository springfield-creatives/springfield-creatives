<?php
get_header();

$no_hero = false;
if(is_archive() || is_taxonomy()){

  $title = 'SGFC Shop';
	$banner_img = get_field('shop_hero', 'options')['url'];

}else if(is_single()){
	$no_hero = true;
}

if(empty($banner_img))
	$banner_img = get_stylesheet_directory_uri() . '/media/images/hero.jpg';

if(!$no_hero):
  ?>
  <section class="hero overlay" style="background-image: url(<?php echo $banner_img ?>);">
    <article>
      <h1><?php echo $title ?></h1>
    </article>
  </section>
  <?php
endif;
?>

<section>
  <article>
    <?php woocommerce_content(); ?>
  </article>
</section>

<?php
get_footer();
?>