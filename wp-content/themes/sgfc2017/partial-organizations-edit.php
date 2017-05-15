<?php

$current_user = wp_get_current_user();
$entry_id = $_GET['entry-id'];

// list or detail?
if(empty($entry_id)){

	sgfc_get_editable_posts($current_user->ID, 'organizations', 'Update an Organization Profile');

}else{

	$job_query = new WP_Query(array(
		'post_type' => 'organizations',
		'p' => $entry_id
	));
	$job_query->the_post();

	// make sure user has permissions to edit this post
	if(!sgfc_has_editor_permission($entry_id, $current_user->ID)){
	
		echo '<h2>You do not have permission to edit this entry.</h2>';

	}else{
		
		?>

		<form method="post">
			<input type="hidden" name="sgfc_organization_profile_edit" value="1">
			<input type="hidden" name="sgfc_organization_profile_id" value="<?php echo get_the_ID() ?>">
			
			<h3>Title</h3>
			<label>
				<input type="text" placeholder="Title" name="sgfc_title" value="<?php the_title() ?>">
			</label>

			<?php

			acf_form(array(
				'field_groups' => array(SGFC_ORGANIZATION_ACF_ID), // the ID of the field group
				'post_id' => $entry_id,
				'form' => false
			));

			acf_form(array(
				'field_groups' => array(SGFC_CONTACT_ACF_ID), // the ID of the field group
				'post_id' => $entry_id,
				'form' => false
			));

			acf_form(array(
				'field_groups' => array(SGFC_EDITORS_ACF_ID), // the ID of the field group
				'post_id' => $entry_id,
				'form' => false
			));
			?>
			<button type="submit">Update Entry</button>
			<a href="?sgfc-delete-entry=<?php echo $_GET['entry-id'] ?>" class="delete-entry-link">Delete this Entry</a>
		</form>
		<?php

		wp_reset_query();
	}
}
?>