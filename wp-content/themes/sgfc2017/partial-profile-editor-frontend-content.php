<?php
define('SGFC_MEMBER_PROFILE_ACF_ID', 2814);
?>
<h2>Your Profile</h2>

<?php
echo do_shortcode('[avatar_upload]');

global $user_ID;
get_currentuserinfo();

acf_form(array(
	'field_groups' => array(SGFC_MEMBER_PROFILE_ACF_ID), // the ID of the field group
	'post_id' => 'user_' . $user_ID,
	'form' => false
));
