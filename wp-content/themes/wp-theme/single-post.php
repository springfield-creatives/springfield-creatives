<?php
get_header();
the_post();

$member_photo = get_wp_user_avatar_src( get_the_author_meta( 'ID' ), 300, null, get_the_author() );

// media
$media = get_gallery_arr(get_the_ID());
?>

<?php include('partials/hero.php'); ?>

<article class="post main">

	<div class="content">
		<?php the_content() ?>
	</div>
	
	<header class="top">
		<span class="date">posted <?php the_time('F j, Y');?></span>
		<span class="author">by <?php the_author_posts_link(); ?></span>
		<?php echo '<a href="' .  get_author_posts_url(get_the_author_meta( 'ID' )) . '" class="thumbnail-image" style="background-image: url(' . $member_photo . ')"></a>'; ?>
	</header>


</article>


<?php

// Media!
if(!empty($media)){
	?>

	<section class="mini-portfolio main">
		<h2 class="middlifier">Media Gallery</h2>
		<ul class="slick-carousel">
			<?php

			foreach($media as $media_item){
				echo '<li><img src="' . $media_item['thumb'] . '" title="' . $media_item['title'] . '" data-big="' . $media_item['src'] . '"/></li>';
			}

			?>
		</ul>
	</section>

	<?php 
}

get_footer() ?>