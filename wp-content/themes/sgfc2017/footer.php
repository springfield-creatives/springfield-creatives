    <section class="alt">
      <article>
        <h2 class="margin text-center">Sponsors</h2>
        <div class="grid grid-center margin">
        	<?php

					// get all sponsor posts level 3 and up
					$stripe_sponsors = get_sponsors(3);

					foreach($stripe_sponsors as $level){
						foreach($level as $sponsor){
							?>
							<div class="unit-1-5 unit-1-3-sm unit-center margin">
								<a href="<?php echo $sponsor['link'] ?>" target="_blank" title="<?php echo $sponsor['name'] ?>">
									<img class="full" src="<?php echo $sponsor['logo']['sizes']['medium'] ?>" />
								</a>
							</div>	
							<?php
					    }
					}

					wp_reset_postdata();

					?>
        </div>
        <p class="text-center"><a class="button" href="<?php the_field('sponsor_signup_url', 'options') ?>">Become A Sponsor</a></p>
      </article>
    </section>
    <footer>
      <div>
        <div class="grid grid-center">
          <div class="unit-1-5 unit-1-4-md unit-1-1-sm margin hidden-sm">
            <h5><a href="<?php the_field('footer_col1_link', 'options') ?>"><?php the_field('footer_col1_title', 'options') ?></a></h5>
            <ul>
							<?php wp_nav_menu( array('theme_location' => 'footer1', 'container' => false, 'items_wrap' => '%3$s' )); ?>
            </ul>
          </div>
          <div class="unit-1-5 unit-1-4-md unit-1-1-sm margin hidden-sm">
            <h5><a href="<?php the_field('footer_col2_link', 'options') ?>"><?php the_field('footer_col2_title', 'options') ?></a></h5>
            <ul>
							<?php wp_nav_menu( array('theme_location' => 'footer2', 'container' => false, 'items_wrap' => '%3$s' )); ?>
            </ul>
          </div>
          <div class="unit-1-5 unit-1-4-md unit-1-1-sm margin hidden-sm">
            <h5><a href="<?php the_field('footer_col3_link', 'options') ?>"><?php the_field('footer_col3_title', 'options') ?></a></h5>
            <ul>
							<?php wp_nav_menu( array('theme_location' => 'footer3', 'container' => false, 'items_wrap' => '%3$s' )); ?>
            </ul>
            <h5><a href="<?php the_field('footer_col3_link2', 'options') ?>"><?php the_field('footer_col3_title2', 'options') ?></a></h5>
            <h5><a href="<?php the_field('footer_col3_link3', 'options') ?>"><?php the_field('footer_col3_title3', 'options') ?></a></h5>
          </div>
          <div class="unit-1-5 unit-1-4-md unit-1-1-sm margin hidden-sm">
            <ul>
							<?php wp_nav_menu( array('theme_location' => 'footer4', 'container' => false, 'items_wrap' => '%3$s' )); ?>
            </ul>
          </div>
          <div class="unit-1-5 unit-1-4-md unit-1-2-sm text-center">
            <p><img class="full" src="<?php echo get_stylesheet_directory_uri() ?>/media/images/logo-inverse.svg" /></p>
            <p class="callout"><?php the_field('footer_col5_callout', 'options') ?></p>
          </div>
        </div>
        <div class="grid">
          <div class="unit-1-1 text-center">
            <ul class="social">
              <li><a target="_blank" href="https://www.facebook.com/springfield.creatives/"><i class="fa fa-facebook"></i></a></li>
              <li><a target="_blank" href="https://twitter.com/sgfcreatives"><i class="fa fa-twitter"></i></a></li>
              <li><a target="_blank" href="https://www.instagram.com/springfieldcreatives/"><i class="fa fa-instagram"></i></a></li>
              <li><a target="_blank" href="<?php bloginfo('rss2_url'); ?>"><i class="fa fa-rss"></i></a></li>
            </ul>
            <p><?php the_field('po_box_oneline', 'options') ?><br /><a href="mailto:info@springfieldcreatives.com">info@springfieldcreatives.com</a></p>
          </div>
        </div>
      </div>
    </footer>

<?php wp_footer() ?>
</body>
</html>