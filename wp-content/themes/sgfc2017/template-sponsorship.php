<?php
/*
Template Name: Sponsorship
 */

get_header();
the_post()
?>

<section class="hero" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/media/images/hero.jpg);">
  <article>
    <h1><?php the_field('headline') ?></h1>
  </article>
</section>
\
<section>
  <article>
    <div class="grid">
      <div class="unit-1-2 unit-1-1-sm">
        <h3>Why Sponsor Springfield Creatives?</h3>
        <p class="callout"><?php the_field('why_sgfc_blurb') ?></p>
      </div>
      <div class="unit-1-2 unit-1-1-sm">
      	<?php
      	$features = get_field('what_we_do_features');
      	foreach($features as $feature):
      		?>
	        <div class="grid small">
	          <div class="unit-1-5 margin">
	            <img class="full" src="<?php echo get_stylesheet_directory_uri() ?>/media/images/<?php echo $feature['icon'] ?>.svg" />
	          </div>
	          <div class="unit-4-5 margin">
	            <h4><?php echo $feature['title'] ?></h4>
	            <p><?php echo $feature['info'] ?></p>
	            <p class="clean"><a href="<?php echo $feature['link'] ?>"><?php echo $feature['button_label'] ?></a></p>
	          </div>
	        </div>
	        <?php
        endforeach;
        ?>
      </div>
  </article>
</section>


<?php
get_footer();