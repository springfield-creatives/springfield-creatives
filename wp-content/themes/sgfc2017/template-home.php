<?php
/*
Template Name: Homepage
 */

get_header();
the_post()
?>

<section class="hero" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/media/images/hero.jpg);">
  <article>
    <h1><?php the_field('headline') ?></h1>
  </article>
</section>

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
          <img src="<?php echo get_stylesheet_directory_uri() ?>/media/images/calendar.svg" />
        </div>
        <div class="unit-4-8 unit-4-6-md unit-3-4-sm unit-center">
          <h4><?php echo $meeting_date ?>: <?php echo $meeting_title ?></h4>
          <p class="clean"><a href="<?php echo $meeting_link ?>">More Information ›</a></p>
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
	        <p><img class="full" src="<?php echo get_stylesheet_directory_uri() ?>/media/images/<?php echo $callout['icon'] ?>.svg" height="225" /></p>
	        <h4><?php echo $callout['title'] ?></h4>
	        <p><?php echo $callout['cta'] ?></p>
	        <p class="clean"><a href="<?php echo $callout['link'] ?>"><?php echo $callout['button_label'] ?><i class="fa fa-angle-right"></i></a></p>
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
<section>
  <article>
    <div class="grid">
      <div class="unit-1-2 unit-1-1-sm">
        <h3>What We Do</h3>
        <p class="callout"><?php the_field('what_we_do_headline') ?></p>
        <?php the_field('what_we_do_details') ?>
      </div>
      <div class="unit-1-2 unit-1-1-sm">
      	<?php
      	$features = get_field('what_we_do_features');
      	foreach($features as $feature):
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