<?php
/*
Template Name: Members
*/

get_header();
the_post();

include('partials/hero.php');

?>

<section class="wysiwyg">	
	<div class="middlifier">
		<?php the_content() ?>
	</div>
</section>

<section class="contact">
	<header>
		<h2>Become a Member</h2>
	</header>
	<article>
		<?php gravity_form('Member Signup', false, true); ?>
	</article>
</section>

<?php
get_footer();
?>