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

    <?php
    if( defined('SGFC_BUGHERD_KEY') ):
      ?>
      <script type='text/javascript'>
        (function (d, t) {
          var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
          bh.type = 'text/javascript';
          bh.src = 'https://www.bugherd.com/sidebarv2.js?apikey=<?php echo SGFC_BUGHERD_KEY ?>';
          s.parentNode.insertBefore(bh, s);
          })(document, 'script');
      </script>
      <?php
    endif;
    ?>

  </head>
	<body <?php body_class(); ?> id="<?php echo get_template_name(); ?>">
    <header class="site-header">
      <span>
        <span></span>
      </span>
      <div>
        <h2><a href="<?php bloginfo('url') ?>">Springfield Creatives</a></h2>
        <nav>
          <!-- Append "current" class to links for active state -->
          <ul class="primary">
						<?php
            wp_nav_menu( array('theme_location' => 'primary', 'container' => false, 'items_wrap' => '%3$s' ));

            $nav_button_link = get_bloginfo('wpurl') . '/become-a-member/';
            $nav_button_label = 'Become a Member';

            echo '<li class="button menu-item">';
            echo '<a href="' . $nav_button_link . '">' . $nav_button_label . '</a>';

            echo '</li>';
            ?>
          </ul>
          <ul class="secondary">
						<?php
            
            wp_nav_menu( array('theme_location' => 'utility', 'container' => false, 'items_wrap' => '%3$s' ));
            
            // login link (if not logged in already)
            if(is_user_logged_in()){
              echo '<li class="menu-item">';
                echo '<a href="' . get_bloginfo('wpurl') . '/my-account">My Account</a>';
                // woocommerce_account_navigation();
              echo '</li>';
            } else {
              echo '<li class="menu-item"><a href="' . get_bloginfo('wpurl') . '/my-account">Login</a></li>';
            }

            // Cart
            global $woocommerce;

            $cart_url = $woocommerce->cart->get_cart_url();
            $cart_qty = $woocommerce->cart->get_cart_contents_count();
            $cart_count_text = $cart_qty == 0 ? '' : ' (' . $cart_qty . ')';
            echo '<li><a href="' . $cart_url . '"><i class="fa fa-shopping-cart"></i> Cart' . $cart_count_text . '</a></li>'
            ?>
          </ul>
        </nav>
      </div>
    </header>