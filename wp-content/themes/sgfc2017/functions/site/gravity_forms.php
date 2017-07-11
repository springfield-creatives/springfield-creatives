<?php


add_filter( 'gform_pre_render', 'add_input_type_gravity_forms' );
function add_input_type_gravity_forms( $form ) {
  foreach ( $form['fields'] as $f => $field )
    $form['fields'][$f]['cssClass'] .= ' input-type-' . $field['type'];

  return $form;
}


// prepopulate business data
add_filter( 'gform_pre_render_' . SGFC_JOB_POST_FORM_ID, 'sgfc_populate_business_select_field' );
add_filter( 'gform_pre_validation_' . SGFC_JOB_POST_FORM_ID, 'sgfc_populate_business_select_field' );
add_filter( 'gform_pre_submission_filter_' . SGFC_JOB_POST_FORM_ID, 'sgfc_populate_business_select_field' );


// populate the models dropdown in gravity forms
function sgfc_populate_business_select_field( $form ) {

    foreach ( $form['fields'] as &$field ) {

        // if ( $field->type != 'select' ) {
        //     continue;
        // }

        if(strpos( $field->cssClass, 'sgfc_populate_businesses_and_organizations' ) !== false){


        	$choices = array();

        	$mycustom_q = new WP_Query(array(
						'post_type' => array('businesses', 'organizations'),
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC'
					));
					while($mycustom_q->have_posts()): $mycustom_q->the_post();
            $choices[] = array( 'text' => get_the_title(), 'value' => get_the_ID() );
					endwhile;

					wp_reset_query();

	        // update 'Select a Post' to whatever you'd like the instructive option to be
	        // $field->placeholder = 'Select a model';
	        $field->choices = $choices;


        }

    }

    return $form;
}


// set submitted biz/orgs logos in the correct ACF field
add_action( 'gform_after_submission', 'set_post_content', 10, 2 );
function set_post_content( $entry, $form ) {

    if($form['id'] != SGFC_BUSINESS_POST_FORM_ID && $form['id'] !=  SGFC_ORGANIZATION_POST_FORM_ID)
        return;

    $thumb_id = get_post_thumbnail_id($entry['post_id']);
    if(empty($thumb_id))
        return;

    //updating post
    update_field('logo', $thumb_id, $entry['post_id']);

}