
	<footer class="footer--main">
		<p>
			Want to keep up on the daily activities of Springfield Creatives?
			<span>Like our Facebook page.</span>
		</p>
		<a class="fb" href="https://www.facebook.com/pages/Springfield-Creatives/620529168034609" target="_blank"><i></i></a>
	</footer>

	<script src="<?php bloginfo('template_directory') ?>/assets/scripts/vendor/jquery.pin.min.js" ></script>
	<script src="<?php bloginfo('template_directory') ?>/assets/scripts/main.js" ></script>

	<?php if(is_user_logged_in()){ ?>
		<!-- BugHerd -->
		<script type='text/javascript'>
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