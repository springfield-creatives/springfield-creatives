<?php
/*
Template Name: Blog
*/
get_header();
the_post();


include('partials/hero.php');

// prepare loop stuffs
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$updates = new WP_Query(array(
    "post_type" => "post",
    "posts_per_page" => get_option('posts_per_page'),
    'paged' => $paged
));
?>

    <section class="post-list main">
        <div class="middlifier posts-wrap">
          <?php

					sc_render_article_list($updates);

          if ($updates->max_num_pages > 1 ) { 
	          // pagination
						echo '<nav id="pagination" class="pagination clearfix">';  
						$current_page = max(1, get_query_var('paged')); 
						echo paginate_links(array(  
						    'base' => get_pagenum_link(1) . '%_%',  
						    'format' => 'page/%#%/',  
						    'current' => $current_page,  
						    'total' => $updates->max_num_pages,  
						    'prev_next'    => true,  
						    'type'         => 'list',  
						));  
						echo '</nav>'; 

					}
					?>
        </div>
    </section>

<?php get_footer() ?>