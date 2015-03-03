<?php
add_filter( 'user_search_columns', 'sc_search_display_name', 10, 3 );
    
function sc_search_display_name( $search_columns, $search, $this ) {
    $search_columns[] = 'display_name';
    return $search_columns;
}