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

		// render the articles
		sc_render_article_list($articles, $list_layout);
		

		?>
	</div>
</section>