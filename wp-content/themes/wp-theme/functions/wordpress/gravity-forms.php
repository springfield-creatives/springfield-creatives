<?php
add_action("gform_field_css_class", "custom_class", 10, 3);

function custom_class($classes, $field, $form){
    $classes .= " " . $field["type"];
    return $classes;
}