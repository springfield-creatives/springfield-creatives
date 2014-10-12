<section class="post page">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <?php

                $links = array(
                    'Homepage' => get_field('website_url', get_the_ID()),
                    'Facebook' => get_field('facebook_url', get_the_ID()),
                    'Twitter' => get_field('twitter_url', get_the_ID()),
                    'LinkedIN' => get_field('linkedin_url', get_the_ID())
                );

                // Check if all are empty
                $empty_links = 0;
                $length = count($links);
                foreach ($links as $media) {
                    if (empty($media))
                        $empty_links++;
                }

                $empty_links = ($empty_links == $length);

            ?>

            <article class="article">
                <header>

                    <h1 class="title">
                        <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h1>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="featured-image">
                            <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php echo the_post_thumbnail('thumbnail'); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                </header>

                <div class="content">
                    <?php // Not sure if there is a excerpt ACF for these ?>
                    <?php the_excerpt(); ?>
                </div>

                <footer>
                    <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" class="learn-more">Learn More</a>

                    <?php if (!$empty_links) : ?>
                        <ul class="links">
                            <?php foreach ($links as $media => $url) : ?>
                                <?php if (empty($url)) continue; ?>
                                <li class="item <?php echo strtolower($media); ?>">
                                    <a href="<?php echo $url; ?>" title="<?php echo $media; ?>" class="icon <?php echo strtolower($media); ?>">
                                        <?php echo $media; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                </footer>

            </article>

        <?php endwhile; ?>

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