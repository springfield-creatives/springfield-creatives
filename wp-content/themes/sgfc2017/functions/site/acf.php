<?php

$sgfc_icons = array(
	'find' => 'Map Pin on Yellow',
	'member' => 'Map Pin on Orange',
	'hire' => 'Person - Blue',
	'business' => 'Person - Orange',
	'job' => 'Website',
	'calendar' => 'Calendar',
	'pencil' => 'Pencil - Black',
	'pencil-alt' => 'Pencil - Yellow'
);

if(function_exists('acf_add_options_page')) { 

	acf_add_options_page();

}

// add icons select values
function sgfc_acf_load_icon_choices( $field ) {
		global $sgfc_icons;
    
    // reset choices
    $field['choices'] = array();
        
    foreach( $sgfc_icons as $slug => $label ) {
        
        $field['choices'][ $slug ] = $label;
        
    }

    // return the field
    return $field;
    
}

add_filter('acf/load_field/name=icon', 'sgfc_acf_load_icon_choices');
