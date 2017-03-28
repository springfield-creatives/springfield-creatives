<?php
get_header();

if(is_home() || is_archive()){

  $title = 'News';
	$banner_img = get_field('news_banner', 'options');

}else{

  the_post();
  $title = get_the_title();
  $is_single = true;

	$banner_img = get_field('banner');

}

if(empty($banner_img))
    $banner_img = get_field('default_banner', 'options');

?>
<section class="hero overlay" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/media/images/hero.jpg);">
  <article>
    <h1><?php echo $title ?></h1>
  </article>
</section>
<section>
  <article>
    <?php

    if($is_single){

      the_content();

    }else{
      while(have_posts()): the_post();
        ?>
        <div class="post">

          <div class="details">

            <h3>
              <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
            </h3>

            <p><?php the_excerpt() ?> <em>Read more</em></p>

          </div>

        </div>
        <?php
      endwhile;
    }
    ?>
  </article>
</section>
<?php
get_footer();
?>