<?php 
/*

This partial expects $profile array to be defined as follows:

$profile = array(
	"title" => "Herbie Hancock", //required
	"logo" => 'http://sc.com/uploads/biz-logo.jpg', // this gets put on top of header
	"subhead" => '<a href="http://sc.com/industry/jazz">Jazz Musician</a>',
	"cover_img" => 'http://sc.com/uploads/cover-image.jpg',
	"featured_img" => 'http://sc.com/uploads/profile-pic.jpg', // required when logo is not supplied
	"description" => "<p>Springfield Creatives is a collaborative group blah blah blah</p>",
	"hours" => "Sunday: Closed <br />Monday: 8am-5pm <br/> etc...",
	"contact_links" => array(
		'phone' => array(
			'title' => '417.693.2229',
			'url' => 'tel:4176932229'
		),
		'website' => array(
			'title' => 'SELFinteractive.com',
			'url' => 'http://selfinteractive.com'
		),
		'email' => array(
			'title' => 'charlie@selfinteractive.com',
			'url' => 'mailto:charlie@selfinteractive.com'
		),
		'address' => array(
			'title' => '123 N. South Ave<br/>Springfield, MO 65806',
			'url' => 'https://www.google.com/maps/place/123+N.+South+Ave,+Springfield,+MO+65806/'
		)
	),
	"social_links" => array(
		'facebook' => 'http://facebook.com/my-page',
		'twitter' => 'http://twitter.com/my-page',
		'instagram' => 'http://instagram.com/instagram',
		'google' => 'http://googleplus.com/my-page',
		'dribbble' => 'http://dribbble.com/my-page',
		'youtube' => 'http://dribbble.com/my-page',
		'tumblr' => 'http://dribbble.com/my-page',
		'vimeo' => 'http://dribbble.com/my-page',
		'soundcloud' => 'http://soundcloud.com/my-page'
	),
	"media" => array(
		array(
			'type' => 'image',
			'title' => "My dog",
			'thumb' => "http://sc.com/uploads/thumbnail.jpg",
			'src' => "http://sc.com/uploads/big-pic.jpg" // required.
		),
		array(
			'type' => 'video',
			'title' => "My dog",
			'thumb' => "http://sc.com/uploads/thumbnail.jpg", // if omited, a placeholder will be used
			'src' => "http://youtube.com/?v=123456" // required. can be full url to most popular video services
		)
	)

);

*/

$fa_icons = array(

	// social 
	'facebook' => 'fa-facebook',
	'twitter' => 'fa-twitter',
	'instagram' => 'fa-instagram',
	'google' => 'fa-google-plus',
	'dribbble' => 'fa-dribbble',
	'youtube' => 'fa-youtube',
	'tumblr' => 'fa-tumblr',
	'vimeo' => 'fa-vimeo-square',
	'soundcloud' => 'fa-soundcloud',
	'medium' => 'fa-medium',

	// contact
	'website' => 'external-link',
	'phone' => 'phone',
	'email' => 'envelope',
	'address' => 'map-marker',

);

if(!empty($profile['logo'])){
	$hero_text = '<img src="' . $profile['logo'] . '" alt="' . $profile['title'] . '">';
}else{
	$hero_text = $profile['title'];
}

if(!empty($profile['cover_img']))
	$hero_img = $profile['cover_img'];

get_header();
require('hero.php');
?>

<!-- Main About Area -->
<section class="profile-about main">
	<div class="middlifier">
		<article class="intro">
			<h2><?php echo $profile['title'] ?></h2>
			<h3><?php echo $profile['subhead'] ?></h3>
		</article>
		<article class="featured">
			<?php
			if(!empty($profile['contact-links']['address'])){

				// echo a map
				$safe_address = urlencode(
					str_replace('<br />', '',
						str_replace('<br/>', '', $profile['contact-links']['address'])
					)
				);
				echo '<iframe src="https://www.google.com/maps/embed/v1/search?key=AIzaSyC9_2YM2sPM3qgTwlfEO9oYCotYT8ZlF3U&q=' . $safe_address . '" width="100%" height="350" frameborder="0" style="border:0"></iframe>';

				
			}else{

				// echo a featured image
				echo '<img src="' . $profile['featured_img'] . '" title="' . $profile['title'] . '" />';

			}
			?>
		</article>
		<article class="description">
			<?php echo $profile['description']; ?>
		</article>
		<article class="contact-info">
			<?php

			// Hours
			if(isset($profile['hours'])){
				?>
				<div class="list">
					<h4>Hours</h4>
					<div>
						<?php echo $profile['hours']; ?>
					</div>
				</div>
				<?php
			}

			// Contact info
			?>
			<div class="list">
				<h4>Contact</h4>
				<ul>
					<?php
					foreach($profile['contact_links'] as $key => $contact_info){
						$class = isset($fa_icons[$key]) ? $fa_icons[$key] : '';
						echo '<li class="' . $class . '"><a href="' . $contact_info['url'] .'">' . $contact_info['title'] . '</a><li>';
					}
					?>
				</ul>
			</div>

		</article>

		<?php

		// Social links
		echo '<article class="links">';
			echo '<ul>';

				foreach($profile['social_links'] as $key => $link_info){
					$class = isset($fa_icons[$key]) ? $fa_icons[$key] : '';
					echo '<li><a class="fa ' . $class . '" href="' . $link_info['url'] . '" title="' . $link_info['title'] . '"></a></li>';
				}

			echo '</ul>';
		echo '</article>';

		?>
	</div>
</section>
<!-- End Main About Area -->

<?php

// Media!
if(!empty($profile['media'])){
	?>

	<section class="mini-portfolio main">
		<ul class="slick-carousel">
			<?php

			foreach($profile['media'] as $media){

				// use default thumbnail for video if not specified
				if($media['type'] == 'video' && !isset($media['thumb']))
					$media['thumb'] = get_field('default_video_thumbnail', 'option');

				echo '<li><img src="' . $media['thumb'] . '" title="' . $media['title'] . '" data-big="' . $media['src'] . '"/></li>';
			}

			?>
		</ul>
	</section>

	<?php 
}


get_footer();
?>