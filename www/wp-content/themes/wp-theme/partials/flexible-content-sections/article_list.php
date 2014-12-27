<section class="post-list main">
	<div class="middlifier">
		<?php
		$title = get_sub_field('section_title');
		if(!empty($title))
			echo "<header><h2>$title</h2></header>";


		switch(get_sub_field('articles')){
			case 'specific':

				$selected = get_sub_field('selected_articles');
				if(!is_array($selected))
					$selected = array($selected);

				$news = new WP_Query(array(
					"post__in" => $selected,
					"posts_per_page" => get_sub_field('number_of_articles')
				));

			break;

			case 'recent':
				$news = new WP_Query(array(
					"post_type" => "post",
					"posts_per_page" => get_sub_field('number_of_articles')
				));

			break;
		}

		while( $news->have_posts() ) {
			$news->the_post();

			// determine photo to use. use hero unless it's not defined.
			$hero_image = get_field( 'hero_image' );
			if( !empty($hero_image) ){
				$featured_img = '<img src="' . $hero_image['sizes']['square-medium'] . '" alt="" />';
			}else{
				$featured_img = get_avatar( get_the_author_meta( 'ID' ), 300, null, get_the_author() );
			}

			?>
			<article class="post">
				<header>
					<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
					<span class="date">posted <?php the_time('F j, Y');?></span>
					<a href="<?php the_permalink() ?>"><?php echo $featured_img ?></a>
				</header>

				<div class="content">
					<?php the_excerpt() ?>
					<a href="<?php the_permalink() ?>" class="read-more secondary-button">Read More</a>
				</div>

			</article>
			<?php
		}

		wp_reset_postdata();

		?>
	</div>
</section>