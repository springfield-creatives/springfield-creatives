<?php
get_header();

$hero_page_option_prefix = $wp_query->query['post_type'] . '_directory';

include('partials/hero.php');

include('partials/directory-list.php');

?>


<section class="wysiwyg">
    <div class="middlifier">
        <?php the_field($hero_page_option_prefix . '_intro', 'options') ?>
    </div>
</section>

<?php

get_footer();