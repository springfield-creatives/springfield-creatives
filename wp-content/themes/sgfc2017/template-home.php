<?php
/*
Template Name: Homepage
 */

get_header();
the_post();

require('partial-hero.php');
?>

<?php
// get next meeting
global $post;

$events = tribe_get_events( array(
  'posts_per_page' => 1,
  'start_date' => date( 'Y-m-d H:i:s' ),
  'tax_query' => array(
    array(
      'taxonomy' => 'tribe_events_cat',
      'field' => 'terms_id',
      'terms' => SGFC_EVENT_MEETINGS_CAT
    )
  )
) );

foreach ( $events as $post ):
  setup_postdata( $post );

  $meeting_date = tribe_get_start_date( $post );
  $meeting_title = get_the_title();
  $meeting_link = get_permalink();
  
  break;
endforeach;

wp_reset_query();

if(!empty($meeting_date)):
  ?>
  <section class="inverse thin">
    <article>
      <div class="grid grid-center">
        <div class="unit-1-8 unit-1-6-md unit-1-4-sm unit-center">
          <img src="<?php echo get_stylesheet_directory_uri() ?>/media/images/calendar2.svg" />
        </div>
        <div class="unit-4-8 unit-4-6-md unit-3-4-sm unit-center">
          <h4><?php echo $meeting_date ?>: <?php echo $meeting_title ?></h4>
          <p class="clean"><a href="<?php echo $meeting_link ?>">Attend our next monthly meeting ›</a></p>
        </div>
      </div>
    </article>
  </section>
  <?php
endif;
?>

<section>
  <article>
    <div class="grid grid-center">
    	<?php
    	$callouts = get_field('callouts');
    	foreach($callouts as $callout):
    		?>
	      <div class="unit-1-3 unit-1-1-sm margin text-center">
	        <p><img class="full" src="<?php echo get_stylesheet_directory_uri() ?>/media/images/<?php echo $callout['icon'] ?>.svg" height="200" /></p>
	        <h4><?php echo $callout['title'] ?></h4>
	        <p><?php echo $callout['cta'] ?></p>
	        <p class="clean"><a href="<?php echo $callout['link'] ?>"><?php echo $callout['button_label'] ?></a></p>
	      </div>
	      <?php
      endforeach;
      ?>
    </div>
  </article>
</section>

<section class="alt">
  <article>
    <div class="grid">
      <div class="unit-3-5 unit-1-1-sm unit-center margin">
        <h3>Our Mission</h3>
        <p class="callout"><?php the_field('mission') ?></p>
      </div>
      <div class="unit-2-5 unit-1-1-sm unit-center">
        <img class="full" src="<?php echo get_stylesheet_directory_uri() ?>/media/images/logo.svg" />
      </div>
  </article>
</section>

<section class="inverse">
  <article>
    <h3 class="clean text-center">Latest News and Updates</h3>
    <p class="text-center margin-double"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ) ?>">View latest news and updates ›</a></p>
    <div class="grid grid-center">

      <?php
      $news_q = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 3
      ));
      while($news_q->have_posts()): $news_q->the_post();
        $image = get_the_post_thumbnail_url(null, 'square');
        if(empty($image))
          $image = get_field('hero_image')['sizes']['square'];
        ?>
        <div class="unit-1-3 unit-1-1-sm margin">
          <p><a href="<?php the_permalink() ?>"><img class="full" src="<?php echo $image ?>" /></a></p>
          <p class="clean"><?php echo get_the_date() ?></p>
          <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
          <?php the_excerpt() ?>
        </div>
        <?php
      endwhile;

      wp_reset_query();
      ?>

    </div>
  </article>
</section>

<section>
  <article>
    <div class="grid grid-center margin">
      <div class="unit-3-4 unit-1-1-md text-center">
        <h3>What We Do</h3>
        <p class="callout"><?php the_field('what_we_do_details') ?></p>
      </div>
    </div>
    
    <div class="grid">
      <div class="unit-1-2 unit-1-1-sm">
        <?php
        $features = get_field('what_we_do_features');
        $mid_point = round( count($features) / 2 );

        foreach($features as $feature_count=>$feature):
          if($feature_count == $mid_point):
            ?>
            </div>
            <div class="unit-1-2 unit-1-1-sm">
            <?php
          endif;

          ?>
          <div class="grid small">
            <div class="unit-1-5 margin">
              <img class="full" src="<?php echo get_stylesheet_directory_uri() ?>/media/images/<?php echo $feature['icon'] ?>.svg" />
            </div>
            <div class="unit-4-5 margin">
              <h4><?php echo $feature['title'] ?></h4>
              <p><?php echo $feature['info'] ?></p>
              <p class="clean"><a href="<?php echo $feature['link'] ?>"><?php echo $feature['button_label'] ?></a></p>
            </div>
          </div>
          <?php
        endforeach;
        ?>
      </div>
  </article>
</section>


<?php
get_footer();