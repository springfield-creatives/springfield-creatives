<!DOCTYPE html>
<html class="no-js">

<head profile="http://gmpg.org/xfn/11">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" type="image/ico" href="<?php bloginfo('template_directory') ?>/assets/images/favicon.ico" />

	<title><?php wp_title('&raquo;','true','right'); ?> <?php bloginfo('name') ?></title>
	
	<?php wp_head();?>

	<link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/style.css" />

	<script type="text/javascript" src="//use.typekit.net/hlc5scr.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>

<body <?php body_class(); ?> id="<?php echo get_template_name(); ?>">

	<a class="member-login" href="<?php bloginfo('url') ?>/wp-login.php">Member Login</a>

	<header class="header--main">
		<a class="springfield-creatives-logo-wrap" href="<?php bloginfo('wpurl') ?>">
			<img class="springfield-creatives-logo" src="<?php bloginfo('template_directory') ?>/assets/images/logo-2x.png" alt="Springfield Creatives" />
		</a>

		<nav class="nav--top">
			<?php wp_nav_menu( array('theme_location' => 'primary' )); ?>
		</nav>
	</header>
