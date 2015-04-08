<?php

the_post();

// description
$desc = wpautop(get_field('description'));
$meeting_time = get_field('meeting_time');
if(!empty($meeting_time))
	$desc .= '<p><strong>Meeting Time:</strong> ' . $meeting_time;


// members section
$chairs = get_field('committee_chair');
$members = get_field('committee_members');

ob_start();

if (!empty($members)) :
	?>
	<section class="main page">

		<div class="middlifier">
			<h2>Committee Members</h2>
			</div>

		<ul class="directory column-3">
			<?php
			foreach($chairs as $chair)
				render_person_item($chair, "Committee Chair");

			foreach($members as $member)
				render_person_item($member, "Member");
			?>
		</ul>

	</section>
	<?php
endif;

$additional = ob_get_contents();
ob_clean();


// build the $profile var for the partial
$profile = array(
	"title" => get_the_title() . ' Committee',
	"description" => $desc,
	"edit-link" => $edit_link,
	"additional-content" => $additional
);

require('partials/profile.php');
