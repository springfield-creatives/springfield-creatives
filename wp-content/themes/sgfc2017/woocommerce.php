<?php
get_header();

$no_hero = true;
if(is_archive()){

  $title = 'SGFC Shop';
  $banner_img = get_field('shop_hero', 'options')['url'];
  $no_hero = false;

}

if(empty($banner_img))
	$banner_img = get_stylesheet_directory_uri() . '/media/images/hero.jpg';

if(!$no_hero){
  require('partial-hero.php');
} else {
  ?>
  <div class="hero-buffer"></div>
  <?php
}
?>

<section>
  <article>
    <?php woocommerce_content(); ?>
  </article>
</section>

<?php
get_footer();
?>