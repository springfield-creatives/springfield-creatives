<?php
/**
 * A hero banner
*/

	$hero_img = isset($hero_img) ? $hero_img : get_field('hero_image');
	if(empty($hero_img) || !empty($hero_page_option_prefix)){
		// allow containing template to choose with ACF option field to use for hero image
		$opts_hero_img = empty($hero_page_option_prefix) ? 'default_hero_image' : $hero_page_option_prefix . '_hero_image';
		$hero_img = get_field($opts_hero_img, 'options');
		if(empty($hero_img))
			$hero_img = get_field('default_hero_image', 'options');
	}

	$credit = array(
		'name' => get_field('hero_image_credit_name', $hero_img['id']),
		'link' => get_field('hero_image_credit_link', $hero_img['id'])
	);

	// If there is a credit for this photo
	if (!empty($credit['name'])) {
		$credit_text = 'Photo by ' . $credit['name'];

		if (!empty($credit['link'])) {
			$credit_html = '<a href="' . $credit['link'] . '" target="_blank" class="credit">' . $credit_text . '</a>';
		} else {
			$credit_html = '<span class="credit">' . $credit_text . '</span>';
		}
	} else {
		$credit_html = '';
	}

	// set Hero text
	if(is_search()){
		// general search
		$cpt = is_post_type_archive() ? post_type_archive_title('', false) . ' ' : '';
		$hero_text = $cpt . "Search Results";

	}else if(!empty($_GET["member-s"])){
		// member search
		$hero_text = "Member Search Results";
	}else{
		$hero_text = isset($hero_text) ? $hero_text : get_field('hero_text');
		if(strlen($hero_text) === 0)
			$hero_text = empty($hero_page_option_prefix) ? get_the_title() :  get_field($hero_page_option_prefix . '_hero_text', 'options');
	}
?>

<!-- A hero banner -->
<section class="hero" style="background-image: url(<?php echo $hero_img['url'] ?>)">
	<?php echo $credit_html; ?>
	<h1><?php echo $hero_text; ?></h1>
</section>
<!-- End hero banner -->
