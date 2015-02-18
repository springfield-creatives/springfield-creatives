<?php
// pagination
echo '<nav id="pagination" class="pagination clearfix">';  
$current_page = max(1, get_query_var('paged')); 
echo paginate_links(array(  
    'base' => get_pagenum_link(1) . '%_%',  
    'format' => 'page/%#%/',  
    'current' => $current_page,  
    'total' => $wp_query->max_num_pages,  
    'prev_next'    => true,  
    'type'         => 'list',  
));  
echo '</nav>'; 

