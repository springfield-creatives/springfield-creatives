<?php
get_header();
the_post();

$no_hero = false;

// herotown, USA
if(!$no_hero){
  require('partial-hero.php');
} else {
  ?>
  <div class="hero-buffer"></div>
  <?php
}
?>
<section>
  <article>
    <?php
    the_content();
    ?>
    </div>
  </article>
</section>
<?php
get_footer();
?>
