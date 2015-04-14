<?php

if(!current_user_can('member') && empty($_GET['mdata'])){
	// make them log in first
	$member_card_url = get_bloginfo('url') . '/member-card';
	header('Location: ' . get_bloginfo('url') . '/wp-login.php?redirect_to=' . urlencode($member_card_url));
	exit;
}

// don't allow embedding of strip.js (throws error)
function no_stripe_on_member_card() {
	wp_dequeue_script('gforms_stripe_frontend');
}
add_action('wp_enqueue_scripts', 'no_stripe_on_member_card', 100);

// mobile app specific stuff
function sc_member_card_head_meta(){

	// https://gist.github.com/tfausak/2222823
	?>
  <!-- Allow web app to be run in full-screen mode. -->
  <meta name="apple-mobile-web-app-capable"
        content="yes">

  <!-- Make the app title different than the page title. -->
  <meta name="apple-mobile-web-app-title"
        content="Member Card">

  <!-- Configure the status bar. -->
  <meta name="apple-mobile-web-app-status-bar-style"
        content="white">


  <!-- ICONS -->

  <!-- iPad retina icon -->
  <link href="<?php bloginfo('template_directory') ?>/assets/images/icons/apple-touch-icon-152x152.png"
        sizes="152x152"
        rel="apple-touch-icon-precomposed">

  <!-- iPad retina icon (iOS < 7) -->
  <link href="<?php bloginfo('template_directory') ?>/assets/images/icons/apple-touch-icon-144x144.png"
        sizes="144x144"
        rel="apple-touch-icon-precomposed">

  <!-- iPad non-retina icon -->
  <link href="<?php bloginfo('template_directory') ?>/assets/images/icons/apple-touch-icon-76x76.png"
        sizes="76x76"
        rel="apple-touch-icon-precomposed">

  <!-- iPad non-retina icon (iOS < 7) -->
  <link href="<?php bloginfo('template_directory') ?>/assets/images/icons/apple-touch-icon-72x72.png"
        sizes="72x72"
        rel="apple-touch-icon-precomposed">

  <!-- iPhone 6 Plus icon -->
  <link href="<?php bloginfo('template_directory') ?>/assets/images/icons/apple-touch-icon-180x180.png"
        sizes="120x120"
        rel="apple-touch-icon-precomposed">

  <!-- iPhone retina icon (iOS < 7) -->
  <link href="<?php bloginfo('template_directory') ?>/assets/images/icons/apple-touch-icon-114x114.png"
        sizes="114x114"
        rel="apple-touch-icon-precomposed">

  <!-- iPhone non-retina icon (iOS < 7) -->
  <link href="<?php bloginfo('template_directory') ?>/assets/images/icons/apple-touch-icon-57x57.png"
        sizes="57x57"
        rel="apple-touch-icon-precomposed">

 	<?php
}
add_action('wp_head', 'sc_member_card_head_meta');

// set title
function member_card_title(){
	return 'Member Card';
}
add_filter( 'wp_title', 'member_card_title', 1000, 2 );

get_header();


// setup user info
if(!empty($_GET['mdata'])){
	// set user based on encoded data in URL
	$userdata_string = base64_decode($_GET['mdata']);

	// load $userdata with parsed data
	$userdata = array();
	parse_str( $userdata_string, $userdata );

	
	$card_info = array(
		'name' => $userdata['n'],
		'start' => $userdata['s'],
		'end' => $userdata['e'],
		'img' => $userdata['i'],
		'id' => $userdata['d']
	);


}else{

	// load current user info
	$user_id = get_current_user_id();
	$user = get_user_by('id', $user_id);
	$user_data = $user->data;

	// load meta
	$meta = get_user_meta($user_id);

	// convert single-item array values to their first element
	foreach($meta as $k=>$v){
		if(is_array($v) && count($v) == 1)
			$meta[$k] = $v[0];
	}

	// image
	$user_image = get_wp_user_avatar_src( $user_id, 'large', null, $user_data->display_name );

	// Dates
	$start_date = date('M Y', strtotime($user->user_registered));
	$end_date = !empty($meta['membership_expiration']) ? date('M Y', strtotime($meta['membership_expiration'])) : '';

	$card_info = array(
		'name' => $user->display_name,
		'start' => $start_date,
		'end' => $end_date,
		'img' => $user_image,
		'id' => $user_id
	);

}


//////////////////
// RENDER PAGE  //
//////////////////

?>

<script>
	window.memberCardInfo = {
		n: '<?php echo $card_info['name'] ?>',
		s: '<?php echo $card_info['start'] ?>',
		e: '<?php echo $card_info['end'] ?>',
		i: '<?php echo $card_info['img'] ?>',
		d: '<?php echo $card_info['id'] ?>',
	};
</script>

<section class="member-card">

	<div class="iphone-wrap offscreen">
		<div class="iphone-member-card-bg">

		<img class="mc-profile-pic" src="<?php echo $card_info['img'] ?>" title="<?php echo $card_info['name'] ?>" />

		<section class="member-info">
			<h1 class="name"><?php echo $card_info['name'] ?></h1>
			<h2>Since <?php echo $card_info['start'] ?></h2>
			<?php
			if(!empty($card_info['end'])){
				?>
				<h2>Expires <?php echo $card_info['end'] ?></h2>
				<?php
			}
			?>
		</div>

		<a href="<?php echo get_bloginfo('url') ?>/member-perks/" class="perks secondary-button">Member Perks</a>

		<div id="inline-perks">
			<?php

			?>
		</div>

	</div>

</section>

<section class="member-card-info main">

	<div class="middlifier">
		<h1>Membership Card</h1>
		<p>To display your membership card, visit this page on your mobile device after logging in.</p>
	</div>

</section>
<?php

get_footer();
