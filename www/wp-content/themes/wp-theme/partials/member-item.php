<li class="person-item">
    <img src="<?php echo $user_image; ?>" alt="<?php echo $name; ?>" />
    <h3><?php echo $name; ?></h3>
    <h4><?php echo $subtitle ?></h4>
    <?php
		if(is_user_logged_in()){
			?>
			<a href="mailto:<?php echo $email; ?>" class="email">Email</a>
			<?php
		}
	?>
</li>
