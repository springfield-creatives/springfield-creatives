<?php
get_header();

$no_hero = false;


// What type of page is this?
if(function_exists('is_account_page') && is_account_page()){

  $no_hero = true;
  $is_single = true;

}else if(is_home() || is_archive()){

  $title = 'News';
	$banner_img = get_field('news_banner', 'options');

}else{

  the_post();
  $title = get_the_title();
  $is_single = true;

	$banner_img = get_field('banner');

}

// herotown, USA
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