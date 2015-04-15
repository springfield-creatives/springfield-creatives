	<?php
	
	$is_sponsors_template = basename(get_page_template()) == 'template-sponsors.php';

	if(!$is_sponsors_template) {
		?>
		<section class="sponsors-stripe">
			<h4><a href="<?php bloginfo('url') ?>/sponsors/"><?php the_field( 'sponsors_stripe_title', 'option') ?></a></h4>
			<ul>
				<?php

				// get all sponsor posts level 3 and up
				$stripe_sponsors = get_sponsors(3);

				foreach($stripe_sponsors as $level){
					foreach($level as $sponsor){
						?>
						<li>
							<a href="<?php echo $sponsor['link'] ?>" class="sponsor" target="_blank" title="<?php echo $sponsor['name'] ?>" style="background-image: url(<?php echo $sponsor['logo']['sizes']['medium'] ?>)"></a>
						</li>
						<?php
				    }
				}

				wp_reset_postdata();

				?>
			</ul>
			<a href="<?php bloginfo('url') ?>/sponsors/" class="view-all secondary-button">View All</a>
		</section>
		<?php
	}
	?>

	<footer class="footer--main">
		<p>
			Want to keep up on the daily activities of Springfield Creatives?
			<span>Like our Facebook page.</span>
		</p>
		<a class="fb" href="https://www.facebook.com/pages/Springfield-Creatives/620529168034609" target="_blank"><i></i></a>
	</footer>

	<script src="<?php bloginfo('template_directory') ?>/assets/scripts/vendor/jquery.pin.min.js" ></script>
	<script src="<?php bloginfo('template_directory') ?>/assets/scripts/main.js?v=1.0.1" ></script>

	<?php if(is_user_logged_in()){ ?>
		<!-- BugHerd -->
		<script type='text/javascript'>
		if(jQuery('body.sc-page-member-card').length == 0)
			(function (d, t) {
			  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
			  bh.type = 'text/javascript';
			  bh.src = '//www.bugherd.com/sidebarv2.js?apikey=qevxe4i5vqhhij2xizq6tg';
			  s.parentNode.insertBefore(bh, s);
			  })(document, 'script');
		</script>
		<!-- End BugHerd -->
	<?php } ?>

	<!-- Google Analytics -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-51161738-1', 'springfieldcreatives.com');
	  ga('send', 'pageview');
	</script>
	<!-- End Google Analytics -->

	<?php wp_footer() ?>
</body>
</html>