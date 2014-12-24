<?php
/*
Template Name: About
*/

get_header();
the_post();

include('partials/hero.php');

?>

<!-- Our Mission -->
<section class="about-our-mission main">
	<div class="middlifier">
		<h2>Our Mission</h2>
		<h3>Springfield Creatives is a collaborative group of local creative professionals committed to the celebration, continued development and promotion of the rich creative community in Springfield, MO and the surrounding areas.</h3>
	</div>
</section>
<!-- End Our Mission -->

<!-- What We Do -->
<section id="what-we-do" class="about-what-we-do main">
	<div class="middlifier">
		<h2>What We Do</h2>
		<ul>
			<li class="specialized-meetups">
				<h3>Specialized Meetups</h3>
				<p>Get together with other professionals in your creative industry.  Meet up, talk shop (or anything) and share ideas.</p>
			</li>

			<li class="speakers">
				<h3>Speakers</h3>
				<p>Industry leaders from multiple disciplines share presentations quarterly on industry changes, new approaches, and creative processes. Local members are spotlighted at monthly meetings, every third Thursday of the month.</p>
			</li>

			<li class="meetings">
				<h3>Meetings</h3>
				<p>Monthly meetings are every third Thursday of the month. Get group updates, see member spotlights, and learn about upcoming events. </p>
			</li>

			<li class="social">
				<h3>Social</h3>
				<p>Meet, network, collaborate and socialize with other industry professionals, from many creative disciplines.</p>
			</li>

			<li class="promotion">
				<h3>Promotion</h3>
				<p>Members are promoted on the Springfield Creatives Directory to area companies and leaders, along with a free open job posting page for creative opportunities. </p>
			</li>

			<li class="advocacy">
				<h3>Advocacy</h3>
				<p>Springfield Creatives advocates for the needs and understanding of creative professionals to the business community and city organizations. </p>
			</li>

			<li class="students">
				<h3>For Students</h3>
				<p>Students join for free and benefit from early industry engagement, and yearly portfolio reviews are provided in the fall.</p>
			</li>
		</ul>
	</div>
</section>
<!-- End What We Do -->

<!-- Charter Board Members -->
<section id="charter-board-members" class="charter-board-members main">
	<div class="middlifier">
		<h2>Board Members</h2>

		<p><?php the_field('chart_board_members_intro'); ?></p>

		<?php

		if( have_rows('board_members') ):

			echo '<ul class="post-list directory column-2">';

			while( have_rows('board_members') ): the_row(); 

				// vars
				$user_data = get_sub_field('person');
				
				$title = get_sub_field('title');

				render_person_item($user_data, $title);

			endwhile;

			echo '</ul>';

		endif;

		?>
	</div>
</section>
<!-- End Charter Board Members -->

<?php
get_footer();
?>