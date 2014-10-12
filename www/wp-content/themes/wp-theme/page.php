<?php
get_header();
the_post();

include('partials/hero.php');

?>

<section class="wysiwyg">	
	<div class="middlifier">
		<?php the_content() ?>
	</div>
</section>

<?php
get_footer();
?>