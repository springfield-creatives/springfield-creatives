<!DOCTYPE html>
<html class="no-js">

<head profile="http://gmpg.org/xfn/11">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" type="image/ico" href="<?php bloginfo('template_directory') ?>/assets/images/favicon.ico" />

	<title><?php wp_title('&raquo;','true','right'); ?> <?php bloginfo('name') ?></title>
	
	<?php wp_head();?>

	<link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/style.css?v=1" />

	<script type="text/javascript" src="//use.typekit.net/hlc5scr.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>

<body <?php body_class(); ?> id="<?php echo get_template_name(); ?>">

	<nav class="nav--menu">
		<?php
		if(!is_user_logged_in()){
			?>

			<div class="right">
				<a href="<?php bloginfo('url') ?>/wp-login.php">Members Login</a>
			</div>

			<?php
		}else{
			$cur_user = wp_get_current_user();
			?>

			<div class="right">
				<!-- <a href="#">Become a Member</a> -->
				<div class="menu--user">
					<a class="toggle-menu" href="<?php echo get_author_posts_url($cur_user->ID) ?>">
						<img src="<?php echo get_wp_user_avatar_src( $cur_user->ID ); ?>" alt="" />
						<span><?php echo $cur_user->user_firstname ?></span>
					</a>
					<ul>
						<li><a href="<?php bloginfo('url') ?>/member-card/">Membership Card</a></li>
						<!-- <li><a href="#">Perks</a></li> -->
						<!-- <li><a href="#">Manual</a></li> -->
						<li class="section"><a href="<?php bloginfo('url') ?>/wp-admin/profile.php">Edit Profile</a></li>
						<li><a href="<?php echo wp_logout_url() ?>">Log Out</a></li>
					</ul>
				</div>
			</div>

			<?php
		}
		?>
	</nav>

	<header class="header--main">
		<a class="springfield-creatives-logo-wrap" href="<?php bloginfo('url') ?>">
			<img class="springfield-creatives-logo" src="<?php bloginfo('template_directory') ?>/assets/images/logo-2x.png" alt="Springfield Creatives" />
		</a>

		<nav class="nav--top">
			<header>
				<h3>Menu</h3>
			</header>
			<div class="menu-top-navigation-container">
				<?php wp_nav_menu( array('theme_location' => 'primary' )); ?>
			</div>
		</nav>
	</header>