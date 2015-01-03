<?php
/*
Template Name: Blog
*/
get_header();
the_post();


include('partials/hero.php');

// prepare loop stuffs
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$news = new WP_Query(array(
    "post_type" => "post",
    "posts_per_page" => get_option('posts_per_page'),
    'paged' => $paged
));
?>

    <section class="post-list main">
        <div class="middlifier posts-wrap">
            <?php

			sc_render_article_list($news);

            if ($news->max_num_pages > 1 ) {  ?>
			    <nav class="blog-pagination cf">
			        <div class="previous">
			            <?php echo get_next_posts_link( 'Older Entries', $news->max_num_pages ); ?>
			        </div>
			        <div class="next">
			            <?php echo get_previous_posts_link( 'Newer Entries' ); ?>
			        </div>
			    </nav>
			<?php } ?>
        </div>
    </section>

<?php get_footer() ?>