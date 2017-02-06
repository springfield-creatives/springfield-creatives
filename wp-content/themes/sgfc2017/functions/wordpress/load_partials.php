<?php

function self_get_page_sections(){

	// check if the flexible content field has rows of data
	if( have_rows('content_blocks') ):

	     // loop through the rows of data
	    while ( have_rows('content_blocks') ) : the_row();

	  			$cur_sect = get_row_layout();
	  			$filepath = TEMPLATEPATH . '/partials/' . $cur_sect . '.php';

	  			if(file_exists( $filepath )){

						// the partial
		  			include($filepath);

	  			}

	    endwhile;

	else :

	    // no layouts found

	endif;

}