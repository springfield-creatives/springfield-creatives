<?php


/*

We expect $profile array to be defined as follows:

$profile = array(
	"title" => "Herbie Hancock", //required
	"subhead" => '<a href="http://sc.com/industry/jazz">Jazz Musician</a>',
	"callout" => 'asdfasdfasdf',
	"featured_img" => 'http://sc.com/uploads/profile-pic.jpg', // required when logo is not supplied
	"description" => "<p>Springfield Creatives is a collaborative group blah blah blah</p>",
	"hours" => "Sunday: Closed <br />Monday: 8am-5pm <br/> etc...",
	"edit-link" => "http://springfieldcreatives.com/wp-admin/edit.php",
	"skill_title" => "Skillset", // or "Services",
	"skills"=> array('Bowstaff', 'Ninja'),
	"availability"=> array('Bowstaff', 'Ninja'),
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

get_header();

?>


<?php

if(!empty($profile['edit-link'])){
	if($expired)
		echo '<section><a class="secondary-button edit-link" href="https://www.springfieldcreatives.com/members/membership-renewal/">Renew Your Membership</a></section>';
	else
		echo '<section><a class="secondary-button edit-link" href="' . $profile['edit-link'] . '">Edit Profile</a></section>';
}
?>

<section>
  <article>
    <div class="grid grid-center">
      <div class="unit-1-2 unit-1-1-md margin">
        <div class="margin-double">
          <h1><?php echo $profile['title'] ?></h1>
          <h3><?php echo $profile['subhead'] ?></h3>
          <p class="callout"><?php echo $profile['callout'] ?></p>
          <div class="contact">
          	
						<?php
						foreach($profile['contact_links'] as $key => $contact_info){
							
							if(empty($contact_info['title']))
								continue;

							$class = isset($fa_icons[$key]) ? $fa_icons[$key] : '';
							echo '<i class="fa ' . $class . '"></i> <a href="' . $contact_info['url'] .'">' . $contact_info['title'] . '</a><br/>';
						}
						?>

          </div>
          <ul class="social">
          	
						<?php
						foreach($profile['social_links'] as $key => $contact_info){
							
							if($key == 'email')
								continue;

							$class = isset($fa_icons[$key]) ? $fa_icons[$key] : '';
							echo '<li><a href="' . $contact_info['url'] .'"><i class="fa ' . $class . '"></i></a><li>';
						}
						?>

          </ul>
        </div>
        <?php echo $profile['description'] ?>
      </div>
      <div class="unit-1-2 unit-1-1-md margin">
        <p class="margin-double"><img src="<?php echo $profile['featured_img'] ?>" /></p>
        
        <?php
        // MAP
        if(!empty($profile['contact_links']['address']['title'])){

					// echo a map
					$safe_address = urlencode(
						str_replace('<br />', '',
							str_replace('<br/>', '', $profile['contact_links']['address']['title'])
						)
					);
					echo '<iframe class="margin-double" src="https://www.google.com/maps/embed/v1/search?key=AIzaSyCiddn9bKV6xJLFEm8sTQ4k6LtUTAO9RGg&q=' . $safe_address . '" width="100%" height="350" frameborder="0" style="border:0"></iframe>';

					
				}
				?>


        <div class="grid">

          <?php if(!empty($profile['skills'])): ?>
	          <div class="unit-1-2 unit-1-1-lg">
	            <h3><?php echo $profile['skill_title'] ?></h3>
	            <ul>
	            	<?php
	            	foreach($profile['skills'] as $skill)
		              echo '<li>' . $skill . '</li>';
	              ?>
	            </ul>
	          </div>
	        <?php endif; ?>

          <?php if(!empty($profile['availability'])): ?>
	          <div class="unit-1-2 unit-1-1-lg">
	            <h3>Availability</h3>
	            <ul>
	            	<?php
	            	foreach($profile['availability'] as $availability)
		              echo '<li>' . $availability . '</li>';
	              ?>
	            </ul>
	          </div>
	        <?php endif; ?>

					<?php
					// Hours
					if(isset($profile['hours'])):
						?>
						<div class="unit-1-2 unit-1-1-lg">
							<h3>Hours</h3>
							<div>
								<?php echo $profile['hours']; ?>
							</div>
						</div>
	        <?php endif; ?>
      </div>
    </div>
  </article>
</section>

<?php
// Media!
if(!empty($profile['media']) && !$expired):
	?>
	<section>
	  <article>
	    <h2 class="margin-double text-center">Portfolio</h2>
	    <div class="grid small">
				<?php

				foreach($media as $media_item){
		      echo '<div class="unit-1-5 unit-1-3-md unit-1-2-sm margin-half">';
					echo '<a href="#" data-featherlight="' . $media_item['src'] . '"><img src="' . $media_item['thumb'] . '" alt="' . htmlentities($media_item['title']) . '" /></a>';
					echo '</div>';
				}

				?>
			</div>
		</article>
	</section>
<?php
endif;


if(!empty($profile['additional-content'])):
	?>
	<section>
	  <article>
			<?php echo $profile['additional-content']; ?>
		</article>
	</section>
	<?php
endif;

get_footer();
?>