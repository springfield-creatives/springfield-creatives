<?php
/*
Template Name: Post a Job
 */

get_header();
the_post();

?>
<section class="job-post-container">
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
	    <div class="woocommerce-message text-center">
            <p>Please sign in or create an account before posting your job. If you are not logged in, you won't be able to edit it later.</p>
            <div class="grid account-row">
                <div class="login unit-2-4 text-center">
                    <h3>Log In</h3>
                    <p>Log in to your Springfield Creatives account</p>
                    <?php dynamic_sidebar( 'job-posting' ); ?>
                </div>
                <div class="account unit-2-4 text-center">
                    <h3>Create Account</h3>
                    <p>Create a Springfield Creatives account</p>
                </div>
            </div>
            <h3 class="text-center">Social Login</h3>
            <?php echo do_shortcode('[woocommerce_social_login_buttons]'); ?>
        </div>

	    <?php endif; ?>
        <?php the_content() ?>

  </article>
</section>

<?php
get_footer();