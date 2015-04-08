<?php
/**
 * Renders a list of articles
 * @param  WP_Query Result $articles    A returned WP_Query object ready to be looped over
 * @param  string $list_layout See switch statement for possible layouts
 * @return null              
 */
function sc_render_article_list($articles, $list_layout = "blocks") {

	$article_count = 0;

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

		// set link url
		if(get_post_type() == 'jobs')
			$the_link = get_field('apply_url');
		else
			$the_link = get_permalink();

		// set subtitle text
		if(get_post_type() == 'tribe_events'){
			$subtitle_text = tribe_get_start_date();
		}else if(get_post_type() == 'jobs'){
			$company = get_field('company');
			$subtitle_text = $company->post_title;
		}else if(get_post_type() == 'committee') {
			$subtitle_text = '';
		}else{
			$subtitle_text = 'posted ' . get_the_time('F j, Y');
		}

		// determine photo to use.
	  $post_image_src = get_object_image_src(get_the_ID(), get_post_type());

	  if(!empty($post_image_src)){
	  	$class = get_post_type() == 'jobs' ? ' contain' : '';
			$featured_img = '<a href="' . $the_link . '" class="thumbnail-image' . $class . '" style="background-image: url(' . $post_image_src . ')"></a>';
		}else{
			$featured_img = '';
		}

		// link text
		if(get_post_type() == 'jobs' || get_post_type() == 'committee'){
			$link_text = 'Learn More';
		}else{
			$link_text = "Read More";
		}

		// content
		if(get_post_type() == 'jobs'){
			$the_content = wpautop(get_field('short_description'));
		}else if(get_post_type() == 'committee'){
			$the_content = wpautop(get_field('description'));
		}else{
			$the_content = apply_filters('the_content', get_the_excerpt());
		}

		?>
		<article class="post <?php echo $class . ' ' . get_post_type() ?>">
			<header>
				<h3><a href="<?php echo $the_link ?>"><?php the_title() ?></a></h3>
				<span class="date"><?php echo $subtitle_text ?></span>
				<?php echo $featured_img ?>
			</header>

			<div class="content">
				<?php echo $the_content ?>
				<a href="<?php echo $the_link ?>" class="read-more secondary-button"><?php echo $link_text ?></a>
			</div>

		</article>
		<?php

		$article_count++;
	}

	wp_reset_postdata();
}