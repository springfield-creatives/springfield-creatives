<!DOCTYPE html>
<html>
  <head>
    <title><?php wp_title(''); ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" />
    <?php wp_head();?>
    <script src="https://use.typekit.net/aih1pbt.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <!--[if lt IE 9]>
      <script src="/workspace/media/scripts/ie.js" type="text/javascript"></script>
    <![endif]-->
  </head>
	<body <?php body_class(); ?> id="<?php echo get_template_name(); ?>">
    <header>
      <span>
        <span></span>
      </span>
      <div>
        <h2><a href="<?php bloginfo('url') ?>">Springfield Creatives</a></h2>
        <nav>
          <!-- Append "current" class to links for active state -->
          <ul class="primary">
						<?php wp_nav_menu( array('theme_location' => 'primary', 'container' => false, 'items_wrap' => '%3$s' )); ?>
          </ul>
          <ul class="secondary">
						<?php wp_nav_menu( array('theme_location' => 'utility', 'container' => false, 'items_wrap' => '%3$s' )); ?>
          </ul>
        </nav>
      </div>
    </header>