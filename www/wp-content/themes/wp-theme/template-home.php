<?php
/*
Template Name: Home
*/

get_header();
the_post();
?>

<?php include('partials/hero.php'); ?>

<section class="post-list main">
	<header>
		<h2>Updates</h2>
	</header>

	<?php

	$news = new WP_Query(array(
		"post_type" => "post",
		"posts_per_page" => 3
	));

	while( $news->have_posts() ) {
		$news->the_post();

		// determine photo to use. use hero unless it's not defined.
		$hero_image = get_field( 'hero_image' );
		if( !empty($hero_image) ){
			$featured_img = $hero_image['sizes']['square-medium'];
		}else{
			$member_photo = get_field( 'photo', 'user_' . get_the_author_meta( 'ID' ) );
			$featured_img = $member_photo['sizes']['medium'];
		}

		?>
		<article class="post">
			<header>
				<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
				<span class="date">posted <?php the_time('F j, Y');?></span>
				<a href="<?php the_permalink() ?>"><img src="<?php echo $featured_img ?>" alt="" /></a>
			</header>

			<div class="content">
				<?php the_excerpt() ?>
				<a href="<?php the_permalink() ?>" class="more">Read More</a>
			</div>

		</article>
		<?php
	}

	wp_reset_postdata();

	?>
</section>

<?php
get_footer();
?>