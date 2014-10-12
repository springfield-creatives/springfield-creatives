<?php

get_header();

?>

<section class="wysiwyg">
	<article class="middlifier">
		<?php the_content() ?>
	</article>
</section>

<section class="sponsors-list">

	<?php 
	// $sponsors is where we'll store them by level
	$sponsors = array();

	// get all sponsors except business level
	$sponsors_query = new WP_Query(array(
		'post_type' => 'sponsors',
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'compare' => '!=',
				'key' => 'level',
				'value' => 1
			)
		)
	));

	while($sponsors_query->have_posts()): $sponsors_query->the_post();

		//store each sponsor by level
		$sponsors[ intval(get_field('level')) ][] = array(
			'name' => get_the_title(),
			'logo' => get_field('logo'),
			'link' => get_field('sponsor_link')
		);

	endwhile;

	// sort sponsors by level in reverse
	krsort($sponsors);

	// loop through each level and echo sponsors
	foreach($sponsors as $level => $level_sponsors):

		echo '<ul class="level-' . $level . '">';

		// set correct keys for url size
		switch($level){
			case 2:
				$img_size = "thumbnail";
				break;
			case 3:
				$img_size = "medium";
				break;
			case 4:
				$img_size = "large";
				break;
		}

		foreach($level_sponsors as $sponsor):
			?>

			<li>
				<a href="<?php echo $sponsor['link'] ?>" target="_blank">
					<img src="<?php echo $sponsor['logo']['sizes'][$img_size] ?>" width="<?php echo $sponsor['logo']['sizes'][$img_size . '-width'] ?>" height="<?php echo $sponsor['logo']['sizes'][$img_size . '-height'] ?>" alt="<?php echo $sponsor['name'] ?>" />
					<h3><?php echo $sponsor['name'] ?></h3>
				</a>
			</li>

			<?php
		endforeach;

		echo '</ul>';

	endforeach;
	?>

</section>

<?php
get_footer();
?>