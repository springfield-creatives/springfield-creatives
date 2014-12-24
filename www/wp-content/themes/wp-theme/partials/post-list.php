<section class="post page">

    <?php include('search-filter.php'); ?>

    <?php if (have_posts()) : ?>

        <ul class="post-list column-3">
            <?php
            while (have_posts()) : the_post();
                render_post_list_item();
            endwhile;
            ?>
        </ul>

    <?php else : ?>

        <article class="article error">
            <header>
                <h1>No Articles Found</h1>
            </header>

            <div class="content">
                <p>This page currently does not have any posts.</p>
            </div>

            <footer>

            </footer>
        </article>

    <?php endif; ?>

</section>