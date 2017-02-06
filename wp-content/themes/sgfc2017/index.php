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
<div id="content">

    <div class="hero-banner">

        <div class="wrapper">

            <img src="<?php echo $banner_img ?>" alt="" />

        </div><!-- .wrapper -->

    </div><!-- .hero-banner -->

    <div class="wrapper">

        <div class="primary-content">
	        
	        <?php

	        if($is_single){

              echo '<h2>' . get_the_title() . '</h2>';


	            the_content();


	        }else{
	            while(have_posts()): the_post();
	                
              		?>
                  <div class="post">

                      <div class="photo"><img src="<?php echo $thumb ?>" alt="" /></div>

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

        </div><!-- .primary-content -->

        <div class="secondary-content">

        <?php dynamic_sidebar('global') ?>

        </div><!-- .secondary-content -->

    </div><!-- .wrapper -->

</div><!-- #content -->
<?php
get_footer();
?>