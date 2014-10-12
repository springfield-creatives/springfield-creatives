<?php
get_header();
the_post();

$member_photo = get_field( 'photo', 'user_' . get_the_author_meta( 'ID' ) );
?>

<?php include('partials/hero.php'); ?>

<article class="post main">

	<div class="content">
		<?php the_content() ?>
	</div>
	
	<header class="top">
		<span class="date">posted <?php the_time('F j, Y');?></span>
		<span class="author">by <?php the_author_posts_link(); ?></span>
		<img src="<?php echo $member_photo['sizes']['square-medium'] ?>" alt="<?php the_author(); ?>" />
	</header>

</article>


<?php get_footer() ?>