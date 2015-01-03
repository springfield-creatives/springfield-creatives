<?php
/*
Template Name: Home
*/

get_header();
the_post();
?>

<?php include('partials/hero.php'); ?>

<section class="post-list main">
	<div class="middlifier">
		<header>
			<h2>Updates</h2>
		</header>

		<?php include('partials/blog-list.php'); ?>
	</div>
</section>

<?php
get_footer();
?>