<?php
define('SGFC_MEMBER_PROFILE_ACF_ID', 2814);
?>
<h2>Profile Details</h2>

<form method="post">
	<input type="hidden" name="sgfc_profile_edit" value="1">
	
	<?php
	global $user_ID;
	get_currentuserinfo();

	acf_form(array(
		'field_groups' => array(SGFC_MEMBER_PROFILE_ACF_ID), // the ID of the field group
		'post_id' => 'user_' . $user_ID,
		'form' => false
	));
	?>
	<button type="submit">Update Profile</button>
</form>