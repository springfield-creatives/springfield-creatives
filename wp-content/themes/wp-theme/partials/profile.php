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
	"edit-link" => "http://springfieldcreatives.com/wp-admin/edit.php",
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
	),

	"additional-content" => 'arbitrary html content to go at the end'

);

*/

$fa_icons = array(

	// social 
	'facebook' => 'fa-facebook',
	'twitter' => 'fa-twitter',
	'instagram' => 'fa-instagram',
	'linkedin' => 'fa-linkedin',
	'google' => 'fa-google-plus',
	'dribbble' => 'fa-dribbble',
	'youtube' => 'fa-youtube',
	'tumblr' => 'fa-tumblr',
	'vimeo' => 'fa-vimeo-square',
	'soundcloud' => 'fa-soundcloud',
	'medium' => 'fa-medium',

	// contact
	'website' => 'fa-external-link',
	'phone' => 'fa-phone',
	'email' => 'fa-envelope-o',
	'address' => 'fa-map-marker',

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


<?php
if(!empty($profile['edit-link']))
	echo '<section><a class="secondary-button edit-link" href="' . $profile['edit-link'] . '">Edit Profile</a></section>';
?>

<!-- Main About Area -->
<?php
$soc_links_empty_class = empty($profile['social_links']) ? 'social-links-empty' : '';
?>
<section class="profile-about <?php echo $soc_links_empty_class ?> main">
	<div class="middlifier">
		<article class="intro">
			<h2><?php echo $profile['title'] ?></h2>
			<h3><?php echo $profile['subhead'] ?></h3>
		</article>
		<?php

			echo '<article class="featured">';

			// echo a featured image
			if(!empty($profile['featured_img'])){

				echo '<img src="' . $profile['featured_img'] . '" title="' . $profile['title'] . '" />';

			}else if(!empty($profile['contact_links']['address']['title'])){

				// echo a map
				$safe_address = urlencode(
					str_replace('<br />', '',
						str_replace('<br/>', '', $profile['contact_links']['address']['title'])
					)
				);
				echo '<iframe src="https://www.google.com/maps/embed/v1/search?key=AIzaSyC9_2YM2sPM3qgTwlfEO9oYCotYT8ZlF3U&q=' . $safe_address . '" width="100%" height="350" frameborder="0" style="border:0"></iframe>';

				
			}

			
			?>
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
			if(!empty($profile['contact_links'])){
				?>
				<div class="list">
					<ul>
						<?php
						foreach($profile['contact_links'] as $key => $contact_info){
							$class = isset($fa_icons[$key]) ? $fa_icons[$key] : '';
							echo '<li><i class="fa ' . $class . '"></i><a href="' . $contact_info['url'] .'">' . $contact_info['title'] . '</a><li>';
						}
						?>
					</ul>
				</div>
				<?php
			}
			?>

		</article>

		<article class="description">
			<?php

			echo $profile['description'];

			?>
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
		<div class="slick-carousel">
			<?php

			foreach($media as $media_item){
				echo '<div><img src="' . $media_item['thumb'] . '" title="' . $media_item['title'] . '" data-big="' . $media_item['src'] . '"/></div>';
			}

			?>
		</div>
	</section>

	<?php 
}

if(!empty($profile['additional-content']))
	echo $profile['additional-content'];


get_footer();
?>