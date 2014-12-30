<?php
/*
Template Name: Blog
*/
get_header();
the_post();
?>

<?php include('partials/hero.php'); ?>

    <section class="post-list main">
        <div class="middlifier">
            <?php include('partials/blog-list.php'); ?>
        </div>
    </section>


<?php get_footer() ?>