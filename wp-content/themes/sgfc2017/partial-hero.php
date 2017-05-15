<?php
/**
 * A hero banner
*/



$hero_img = !empty($hero_img) ? $hero_img : get_field('hero_image');
if(empty($hero_img) || !empty($hero_page_option_prefix)){
	// allow containing template to choose with ACF option field to use for hero image
	$opts_hero_img = empty($hero_page_option_prefix) ? 'default_hero_image' : $hero_page_option_prefix . '_hero_image';
	$hero_img = get_field($opts_hero_img, 'options');
	if(empty($hero_img))
		$hero_img = get_field('default_hero_image', 'options');
}

if(!empty($hero_img))
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

if(empty($hero_title)){

	// set Hero title
	if(is_search()){
		
		// general search
		$cpt = is_post_type_archive() ? post_type_archive_title('', false) . ' ' : '';
		$hero_title = $cpt . "Search Results";

	}else{
		$hero_title = !empty($hero_title) ? $hero_title : get_field('hero_text');
		if(strlen($hero_title) === 0)
			$hero_title = empty($hero_page_option_prefix) ? get_the_title() :  get_field($hero_page_option_prefix . '_hero_text', 'options');
	}

}

// hero intro
if(empty($hero_intro))
	$hero_intro = get_field('hero_intro');

// button label/link
if(empty($button_label))
	$buttons = get_field('hero_buttons');

?>

<section class="hero overlay" style="background-image: url(<?php echo $hero_img['sizes']['large'] ?>);">
  <article>
    <h1 class="margin text-center"><?php echo $hero_title ?></h1>
    <?php if(!empty($hero_intro) || !empty($button_label)): ?>
	    <div class="grid grid-center">
	      <div class="unit-2-3 unit-1-1-md text-center">
	      	
	      	<?php if(!empty($hero_intro)): ?>
		        <p class="margin-double"><?php echo $hero_intro ?></p>
		      <?php endif; ?>

	      	<?php
	      	if(!empty($buttons)):
	      		echo '<p>';
	      		
	      		foreach($buttons as $button):
	      			?>
	      			<a class="button" href="<?php echo $button['link'] ?>"><?php echo $button['label'] ?></a>
			        <?php
		        endforeach;

		        echo '</p>';
	        endif;
	        ?>

	      </div>
	    </div>
    <?php endif; ?>
  </article>
</section>