<?php
/*
Template Name: Sponsors
*/
get_header();
the_post();

include('partials/hero.php');



// get all sponsors
$sponsors = get_sponsors();

// loop through each level and echo sponsors
foreach($sponsors as $level => $level_sponsors):

	// set correct index for logo sizes array
	// and # columns
	switch($level){
		case 2:
			$logo_size = "thumbnail";
			$columns_class = "column-3";
			break;
		case 3:
			$logo_size = "medium";
			$columns_class = "column-2";
			break;
		case 4:
			$logo_size = "large";
			$columns_class = "";
			break;
	}

	echo '<section class="sponsors-list posts-wrap level-' . $level . ' ' . $columns_class . '">';
	echo '<div class="middlifier">';
	echo '<h2>' . $sc_sponsorship_level_names[$level] . '</h2>';


	foreach($level_sponsors as $sponsor):
		?>

		<article class="post block">

			<header>
				<?php if($level > 1) { ?>
					<a href="<?php echo $sponsor['link'] ?>" class="image" target="_blank" style="background-image:url('<?php echo $sponsor['logo']['sizes'][$logo_size] ?>')"></a>
				<?php } ?>
				<h3><a href="<?php echo $sponsor['link'] ?>" target="_blank"><?php echo $sponsor['name'] ?></a></h3>
			</header>

		</article>

		<?php
	endforeach;

	echo '</ul>';
	echo '</div>';
	echo '</section>';

endforeach;



get_footer();
?>