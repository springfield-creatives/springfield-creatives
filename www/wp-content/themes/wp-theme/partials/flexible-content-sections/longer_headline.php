<section class="longer-headline main">
	<div class="middlifier">
		<?php
		$title = get_sub_field('section_title');
		if(!empty($title))
			echo "<h2>$title</h2>";

		echo "<h3>" . get_sub_field('text') . "</h3>";
		?>
	</div>
</section>