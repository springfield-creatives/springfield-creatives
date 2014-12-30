<?php

// If this is the blog template get posts_per_page from WP settings otherwise default to whatevs
$isBlogTemplate = basename(get_page_template()) == 'template-blog.php';
$postsPerPage = $isBlogTemplate ? get_option('posts_per_page') : 3;

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$news = new WP_Query(array(
    "post_type" => "post",
    "posts_per_page" => $postsPerPage,
    'paged' => $paged
));

while( $news->have_posts() ) {
    $news->the_post();

    // determine photo to use. use hero unless it's not defined.
    $hero_image = get_field( 'hero_image' );
    if( !empty($hero_image) ){
        $featured_img = '<img src="' . $hero_image['sizes']['square-medium'] . '" alt="" />';
    }else{
        $featured_img = get_avatar( get_the_author_meta( 'ID' ), 300, null, get_the_author() );
    }

    ?>
    <article class="post">
        <header>
            <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
            <span class="date">posted <?php the_time('F j, Y');?></span>
            <a href="<?php the_permalink() ?>"><?php echo $featured_img ?></a>
        </header>

        <div class="content">
            <?php the_excerpt() ?>
            <a href="<?php the_permalink() ?>" class="more">Read More</a>
        </div>

    </article>
<?php
}

wp_reset_postdata();

?>

<?php if ($news->max_num_pages > 1 && $isBlogTemplate) {  ?>
    <nav class="blog-pagination cf">
        <div class="previous">
            <?php echo get_next_posts_link( 'Older Entries', $news->max_num_pages ); ?>
        </div>
        <div class="next">
            <?php echo get_previous_posts_link( 'Newer Entries' ); ?>
        </div>
    </nav>
<?php } ?>