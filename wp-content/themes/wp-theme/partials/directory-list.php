<?php include('search-filter.php'); ?>

<section class="main page">

    <?php if (have_posts()) : ?>

        <ul class="directory column-3">
            <?php
            while (have_posts()) : the_post();
                render_directory_item();
            endwhile;
            ?>
        </ul>
        <?php
        include('pagination.php');
        ?>

    <?php else : ?>

        <article class="no-results">
            <header>
                <h1>Nothing Found</h1>
            </header>

            <div class="content">
                <p>Looks like nothing matches those filters. Please try something else.</p>
            </div>

        </article>

    <?php endif; ?>

</section>