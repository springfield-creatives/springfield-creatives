<section class="post-list main">
	<div class="middlifier posts-wrap">
		<?php
		$title = get_sub_field('section_title');
		if(!empty($title))
			echo "<header><h2>$title</h2></header>";


		$post_type = get_sub_field('post_type');

		// load the articles based on selection method
		switch(get_sub_field('articles')){
			case 'specific':

				$selected = get_sub_field('selected_' . $post_type);
				if(!is_array($selected))
					$selected = array($selected);


				$articles = new WP_Query(array(
					"post__in" => $selected
				));

			break;

			case 'dynamic':

				$orderby = get_sub_field('orderby');
				$order = get_sub_field('order');
				$articles_num = get_sub_field('number_of_articles');

				// config query args based on post type
				if($post_type == 'tribe_events'){

					// based on https://gist.github.com/jo-snips/5112025
					$q_args = array(
						'post_status' => 'publish',
						'post_type' => array(TribeEvents::POSTTYPE),
						'posts_per_page' => $articles_num,
						'order' => $order,
						//required in 3.x
						'eventDisplay' => 'custom'
					);

					if($orderby == 'date'){
						$q_args['meta_key'] = '_EventStartDate';
						$q_args['orderby'] = '_EventStartDate';
					}else{
						$q_args['orderby'] = $orderby;
					}

				} else {

					$q_args = array(
						"post_type" => $post_type,
						"posts_per_page" => get_sub_field('number_of_articles'),
					    'orderby' => $orderby,
					    "order" => $order
					);

				}

				// do the query
				$articles = new WP_Query($q_args);

			break;
		}

		$list_layout = get_sub_field('article_layout');
		$article_count = 0;

		// render the articles
		while( $articles->have_posts() ) {
			$articles->the_post();

			// determine post size
			switch($list_layout) {
				case 'featured':
					$class = 'featured';
					break;

				case 'blocks':
					$class = 'block';
					$block_count = $article_count;
					break;

				case 'featured-blocks':
					if($article_count == 0)
						$class = 'featured';
					else
						$class = 'block';

					$block_count = $article_count - 1;
					break;

				case 'full':
					$class = 'full';

			}

			// maybe add col counter for blocks
			if($class == 'block' && ($block_count % 2) == 0)
					$class .= ' new-row';

			// set "date" text
			if($post_type == 'tribe_events')
				$date_text = tribe_get_start_date();
			else
				$date_text = 'posted ' . get_the_time('F j, Y');

			// determine photo to use. use hero unless it's not defined.
			$hero_image = get_field( 'hero_image' );
			if( !empty($hero_image) ){
				$featured_img = '<img src="' . $hero_image['sizes']['square-medium'] . '" alt="" />';
			}else{
				$featured_img = get_avatar( get_the_author_meta( 'ID' ), 300, null, get_the_author() );
			}

			?>
			<article class="post <?php echo $class . ' ' . $post_type ?>">
				<header>
					<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
					<span class="date"><?php echo $date_text ?></span>
					<a href="<?php the_permalink() ?>"><?php echo $featured_img ?></a>
				</header>

				<div class="content">
					<?php the_excerpt() ?>
					<a href="<?php the_permalink() ?>" class="read-more secondary-button">Read More</a>
				</div>

			</article>
			<?php

			$article_count++;
		}

		wp_reset_postdata();

		?>
	</div>
</section>