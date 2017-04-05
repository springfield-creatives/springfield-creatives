<?php
/*
Template Name: Sponsorship
 */

get_header();
the_post();

require('partial-hero.php');
?>

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
$levels = get_field('sponsorship_levels');
$is_alt = false;
foreach($levels as $level):
  ?>
  <section class="<?php echo $is_alt ? 'alt' : '' ?>">
    <article>
        <div class="grid grid-center">
            <div class="unit-2-3 unit-1-1-md text-center">
                <h2><?php echo $level['title'] ?></h2>
                
                <?php
                if(!empty($level['cost']))
                  echo '<h3>$' . $level['cost'] . '</h3>';
                ?>

                <p class="callout"><?php echo $level['intro'] ?></p>
                <ul class="text-left">
                  <?php
                  foreach($level['feature_list'] as $feature)
                    echo '<li>' . $feature . '</li>'
                  ?>
                </ul>
                <p><a class="button" href="<?php the_field('sponsor_signup_url', 'options') ?>"><?php echo $level['button_cta'] ?></a></p>
            </div>
        </div>
    </article>
  </section>
  <?php

  $is_alt = !$is_alt;

endforeach;
?>

<section class="inverse">
    <article>
        <div class="grid grid-center">
            <div class="unit-2-3 unit-1-1-md text-center">
                <h2>In-kind Sponsorships</h2>
                <p class="callout"><?php the_field('in_kind_blurb') ?></p>
            </div>
        </div>
    <p class="text-center"><a class="button" href="<?php the_field('in_kind_link') ?>"><?php the_field('in_kind_label') ?></a></p>
    </article>
</section>


<?php
get_footer();