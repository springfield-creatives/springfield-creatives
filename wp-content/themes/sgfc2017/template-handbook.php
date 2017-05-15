<?php
/*
Template Name: Handbook
 */

get_header();
the_post();

require('partial-hero.php');
?>
<section>
  <article>
    <div class="grid">
      <div class="unit-1-4 unit-1-1-sm">
        <ul class="sidebar">
        <?php global $post; ?>
        <?php
          if($post->ID == 802){
            echo '<li class="menu-item current-menu-item">';
              echo '<a href="' . get_bloginfo('wpurl') . '/handbook">Overview</a>';
            echo '</li>';
          } else {
            echo '<li class="menu-item">';
              echo '<a href="' . get_bloginfo('wpurl') . '/handbook">Overview</a>';
            echo '</li>';
          }
            
          wp_nav_menu( array('theme_location' => 'handbook', 'container' => false, 'items_wrap' => '%3$s' ));
        ?>
        <ul>
      </div>
      <div class="unit-3-4 unit-1-1-sm">
        <?php
          the_content();
        ?>
      </div>
    </div>
  </article>
</section>
<?php
get_footer();
?>