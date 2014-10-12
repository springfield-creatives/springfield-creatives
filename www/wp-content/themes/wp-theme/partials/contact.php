
<section class="contact main" id="contact">
	<header>
		<h2>Stay Informed <span>or</span> Get Involved</h2>
	</header>
	
	<article>

		<p><?php the_field('contact_intro_content', 'option') ?></p>

		<?php echo do_shortcode('[contact-form-7 id="11" title="Contact"]'); ?>

	</article>
</section>
