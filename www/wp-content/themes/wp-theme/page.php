<?php
get_header();
the_post();

include('partials/hero.php');

// check if the flexible content field has rows of data
if( have_rows('sc_flex') ):

     // loop through the rows of data
    while ( have_rows('sc_flex') ) : the_row();

        include( 'partials/flexible-content-sections/' . get_row_layout() . '.php' );

    endwhile;

endif;

get_footer();
?>