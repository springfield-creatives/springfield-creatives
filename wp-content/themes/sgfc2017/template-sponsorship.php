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
    <div class="grid grid-center margin-double">
      <div class="unit-2-3 unit-1-1-md text-center">
        <h3>Why Sponsor Springfield Creatives?</h3>
        <p class="callout"><?php the_field('why_sgfc_blurb') ?></p>
      </div>
    </div>
    <?php
    	$features = get_field('what_we_do_features');
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
<?php
$levels = get_field('sponsorship_levels');
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
                <p><a class="button" href="<?php the_field('sponsor_signup_url', 'options') ?>"><?php echo $level['button_cta'] ?></a></p>
            </div>
        </div>
        <div class="grid small grid-center margin">
        	<?php

					// get all sponsor posts level 3 and up
					if($key == 0)
            $stripe_sponsors = get_sponsors(4, '==');
          if($key == 1)
            $stripe_sponsors = get_sponsors(3, '==');
          if($key == 2)
            $stripe_sponsors = get_sponsors(2, '==');
          if($key == 3)
            $stripe_sponsors = get_sponsors(1, '==');

					foreach($stripe_sponsors as $sponsorlevel){
						foreach($sponsorlevel as $sponsor){
							?>
							<div class="unit-1-8 unit-1-4-sm unit-center margin">
								<a href="<?php echo $sponsor['link'] ?>" target="_blank" title="<?php echo $sponsor['name'] ?>">
									<div class="circle border"><span><img src="<?php echo $sponsor['logo']['sizes']['medium'] ?>" /></span></div>
								</a>
							</div>	
							<?php
					    }
					}

					wp_reset_postdata();

					?>
        </div>
    </article>
  </section>
  <?php

  $is_alt = !$is_alt;

endforeach;
?>

<section class="<?php echo !$is_alt ? 'alt' : '' ?>">
    <article>
        <div class="grid grid-center">
            <div class="unit-2-3 unit-1-1-md text-center">
                <h2>Corporate Memberships</h2>
                <p class="callout"><?php the_field('in_kind_blurb') ?></p>
            </div>
        </div>
    <p class="text-center"><a class="button" href="<?php the_field('in_kind_link') ?>"><?php the_field('in_kind_label') ?></a></p>
    </article>
</section>


<?php
get_footer();