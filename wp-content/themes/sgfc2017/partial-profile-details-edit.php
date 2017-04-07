<?php
define('SGFC_MEMBER_PROFILE_ACF_ID', 2814);
define('SGFC_GALLERY_ACF_ID', 813);

$current_user = wp_get_current_user();
?>

<form method="post">
	<input type="hidden" name="sgfc_profile_edit" value="1">
	
	<h3>Name</h3>
	<div class="grid" style="margin-bottom: 40px;">
		<div class="unit-1-2 unit-1-1-sm">
			<label>
				<input type="text" placeholder="First Name" name="sgfc_fname" value="<?php echo $current_user->user_firstname ?>">
			</label>
		</div>
		<div class="unit-1-2 unit-1-1-sm">
			<label>
				<input type="text" placeholder="Last Name" name="sgfc_lname" value="<?php echo $current_user->user_lastname ?>">
			</label>
		</div>
	</div>
	<?php

	acf_form(array(
		'field_groups' => array(SGFC_MEMBER_PROFILE_ACF_ID), // the ID of the field group
		'post_id' => 'user_' . $current_user->ID,
		'form' => false
	));

	acf_form(array(
		'field_groups' => array(SGFC_GALLERY_ACF_ID), // the ID of the field group
		'post_id' => 'user_' . $current_user->ID,
		'form' => false
	));
	?>
	<button type="submit">Update Profile</button>
</form>