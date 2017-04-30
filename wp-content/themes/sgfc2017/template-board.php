<?php
/*
Template Name: Board
 */

get_header();
the_post();

require('partial-hero.php');
?>

<section>
    <article>
        <div class="grid grid-center margin">
            <div class="unit-2-3 unit-1-1-md text-center">
                <h3><?php the_field('intro_title') ?></h3>
                <p class="callout"><?php the_field('intro_callout') ?></p>
                <p><?php the_field('intro_paragraph') ?></p>
            </div>
        </div>
        <div class="grid">
            
            <?php
            $members = get_field('board_members');
            foreach($members as $member):
							$user_data = sgfc_prep_user_data($member['member']);

            	?>
	            <div class="unit-1-2 unit-1-1-md margin">
	                <div class="grid">
	                    <div class="unit-1-3">
	                        <p><a href="<?php echo $user_data['link'] ?>"><img class="full rounded" src="<?php echo $user_data['image'] ?>" /></a></p>
	                    </div>
	                    <div class="unit-2-3">
	                        <h3 class="clean"><a href="<?php echo $user_data['link'] ?>"><?php echo $user_data['name'] ?></a></h3>
	                        <p class="callout"><?php echo $member['position'] ?></p>
	                        <p><?php echo $member['about'] ?></p>
	                    </div>
	                </div>
	            </div>
	            <?php
            endforeach;
            ?>
            
        </div>
    </article>
</section>
<section class="alt">
  <article>
    <div class="grid grid-center">
      <div class="unit-3-5 unit-1-1-md text-center">
          <h3 class="clean"><?php the_field('callout_title') ?></h3>
          <p class="callout"><?php the_field('callout_blurb') ?></p>
          <p><a class="button" href="<?php the_field('callout_button_link') ?>"><?php the_field('callout_button_label') ?></a></p>
      </div>
    </div>
  </article>
</section>

<?php require('partial-more-links.php'); ?>

<?php
get_footer();