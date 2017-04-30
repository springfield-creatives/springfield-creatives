<?php
/*
Template Name: About
 */

get_header();
the_post();

require('partial-hero.php');
?>
<section>
  <article>
    <div class="grid grid-center margin">
      <div class="unit-3-4 unit-1-1-md text-center">
        <h3>What We Do</h3>
        <p class="callout"><?php the_field('what_we_do_details') ?></p>
      </div>
    </div>
    <div class="grid">
      <?php
    	$features = get_field('what_we_do_features');
    	foreach($features as $feature):
    		?>
    		<div class="unit-1-2 unit-1-1-sm">
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
        </div>
      <?php
        endforeach;
        ?>
    </div>
  </article>
</section>

<?php require('partial-more-links.php') ?>

<?php
get_footer();