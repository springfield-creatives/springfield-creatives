<?php
get_header();
the_post();

$member_photo = get_avatar( get_the_author_meta( 'ID' ), 300, null, get_the_author() );
?>

<?php include('partials/hero.php'); ?>

<article class="post main">

	<div class="content">
		<?php the_content() ?>
	</div>
	
	<header class="top">
		<span class="date">posted <?php the_time('F j, Y');?></span>
		<span class="author">by <?php the_author_posts_link(); ?></span>
		<?php echo $member_photo ?>
	</header>

</article>


<?php get_footer() ?>