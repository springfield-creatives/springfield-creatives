<?php
/*
Template Name: Membership
 */

get_header();
the_post();

require('partial-hero.php');
?>

<section class="inverse thin">
    <article class="text-center">
        <h3 class="clean">Questions about membership?</h3>
        <p class="callout clean"><a href="/contact/">Contact Us</a></p>
    </article>
</section>

<section>
  <article>
    <div class="grid grid-center margin-double">
      <div class="unit-2-3 unit-1-1-md text-center">
        <h3><?php the_field('why_title') ?></h3>
        <p class="callout"><?php the_field('why_sgfc_blurb') ?></p>
      </div>
    </div>
    <h3 class="text-center"><?php the_field('features_title') ?></h3>
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
    <p class="text-center"><a class="button" href="<?php the_field('member_signup_link') ?>">Sign Me Up</a></p>
  </article>
</section>

<section class="alt">
    <article>
        <div class="grid grid-center margin-double">
            <div class="unit-2-3 unit-1-1-md text-center">
                <h3><?php the_field('students_title') ?></h3>
                <p class="callout"><?php the_field('students_blurb') ?></p>
            </div>
        </div>
        <div class="grid">
          <?php
          $features = get_field('student_features_what_we_do_features');
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
        <p class="text-center"><a class="button" href="<?php the_field('student_signup_link') ?>">Sign Me Up</a></p>
    </article>
</section>

<section class="inverse">
  <article>
    <div class="grid grid-center">
      <div class="unit-2-3 unit-1-1-md text-center">
        <h2>Corporate Memberships</h2>
        <p class="callout"><?php the_field('corporate_blurb') ?></p>
      </div>
    </div>
    <p class="text-center"><a class="button" href="/members/corporate-membership/">More Information</a></p>
  </article>
</section>

<?php
get_footer();