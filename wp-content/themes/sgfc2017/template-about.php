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
    <div class="grid">
      <div class="unit-1-2 unit-1-1-sm">
        <h3>What We Do</h3>
        <p class="callout"><?php the_field('what_we_do_headline') ?></p>
        <?php the_field('what_we_do_details') ?>
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

<section class="inverse">
    <article class="text-center">
        <h3><?php the_field('more_section_title') ?></h3>
        
        <p class="callout">
          <?php
          $link_html_els = array();
          $more_links = get_field('more_section_links');
          foreach($more_links as $link)
            $link_html_els[] = '<a href="' . $link['URL'] . '">' . $link['title'] . '</a>';

          echo join(' | ', $link_html_els);
          ?>
        </p>
        
    </article>
</section>

<?php
get_footer();