<?php
/*
Template Name: Post a Job
 */

get_header();
the_post();

?>
<section>
  <article>
    <h2 class="margin text-center">Post A Job</h2>
    <div class="grid grid-center margin-double">
      <div class="unit-2-3 unit-1-1-md text-center">
        <p class="callout"><?php the_field('intro') ?></p>
      </div>
    </div>

    <?php
    if(!is_user_logged_in()):
    	?>
	    <div class="woocommerce-message"><p>Please sign in or create an account before posting your job. If you are not logged in, you won't be able to edit it later.</p>
    	<?php echo do_shortcode('[woocommerce_social_login_buttons]'); ?></div>
	    <?php
    endif;
    ?>
    <?php the_content() ?>

  </article>
</section>

<?php
get_footer();