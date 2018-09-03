<?php
/*
Template Name: Become a Member
 */

get_header();
the_post();

require('partial-hero.php');
?>

<!--
<section>
<article>
  <div class="grid grid-center margin-double">
    <div class="unit-2-3 unit-1-1-md text-center">
      <h3><?php the_field('why_sgfc_title') ?></h3>
      <p class="callout"><?php the_field('why_sgfc_blurb') ?></p>
    </div>
  </div>
  <?php
  	$features = get_field('features_list');
  	echo '<div class="grid">';
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
  echo '</div>';
  ?>
</article>
</section>
-->
<!--
<?php
$levels = get_field('membership_types');
$is_alt = false;
foreach($levels as $key=>$level):
  ?>
  <section class="<?php echo !$is_alt ? 'alt' : '' ?>">
    <article>
        <div class="grid grid-center margin">
            <div class="unit-2-3 unit-1-1-md text-center">
                <h2><?php echo $level['title'] ?></h2>
                
                <?php
                if(!empty($level['cost']))
                  echo '<h3>$' . $level['cost'] . '</h3>';
                ?>

                <p class="callout"><?php echo $level['intro'] ?></p>
                <ul class="text-left">
                  <?php
                  if(!empty($level['feature_list'])){
                    $features_arr = explode("\r\n", $level['feature_list']);

                    foreach($features_arr as $feature)
                      echo '<li>' . $feature . '</li>';
                  }
                  ?>
                </ul>
                <p><a class="button" href="#join-links"><?php echo $level['button_cta'] ?></a></p>
            </div>
        </div>
        
    </article>
  </section>
  <?php

  $is_alt = !$is_alt;

endforeach;
?>
-->

<section id="join-links" class="<?php echo !$is_alt ? 'alt' : '' ?>">
  <article>
    <div class="grid grid-center">
      <div class="unit-2-3 unit-1-1-md text-center">
        <h2><?php the_field('join_title') ?></h2>
        <p class="callout"><?php the_field('join_blurb') ?></p>
      </div>
    </div>
    <?php echo do_shortcode('[products ids="' . SGFC_STUDENT_MEMBERSHIP_PRODUCT_ID . ',' . SGFC_PROFESSIONAL_MEMBERSHIP_PRODUCT_ID . '"]') ?>
  </article>
</section>


<?php
get_footer();