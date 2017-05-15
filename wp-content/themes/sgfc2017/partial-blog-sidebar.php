<?php
$sidebar_cats = array(
  113 => 'Featured Stories',
  114 => 'Meet-A-Member',
  21 => 'Meeting Recaps',
  23 => 'Group Updates'
);

foreach($sidebar_cats as $cat_id => $cat_name):
  $cat_posts_q = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'cat' => $cat_id
  ));
  if($cat_posts_q->have_posts()) {
    echo '<h3>' . $cat_name . '</h3>';
  }
  while($cat_posts_q->have_posts()): $cat_posts_q->the_post();
    ?>           
    <div>
        <h4 class="clean"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
        <p><?php echo get_the_date() ?><br /><a href="<?php the_permalink() ?>">Read Article</a></p>
    </div>
    <?php
  endwhile;

  wp_reset_query();

endforeach;
?>
