<?php
get_header();
the_post();
?>

<?php include('partials/hero.php'); ?>

<section class="post">
	<div>
		<header>
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 140 ); ?>
			<span class="author">by <?php the_author(); ?></span>
			<span class="date"><?php the_time('F j, Y');?></span>
		</header>

		<article>
			<?php the_content() ?>
		</article>
	</div>
</section>


<?php get_footer() ?>