<?php
/*
Template Name: Committees List
 */

get_header();
the_post();

require('partial-hero.php');


$committees_q = new WP_Query(array(
	'post_type' => 'committee',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC'
	));
while($committees_q->have_posts()): $committees_q->the_post();

	?>
	<section class="<?php echo $is_alt? 'alt' : '' ?>">
		<article>
			<h3 class="margin text-center"><?php the_title() ?></h3>

			<div class="grid">
				<div class="unit-2-5 unit-1-1-md margin">
					<?php
					
					$callout = get_field('callout');
					if(!empty($callout))
						echo '<p class="callout">' . $callout . '</p>';

					the_field('description');

					$email = get_field('email');
					if(!empty($email))
						echo '<p class="text-center"><a class="button" href="mailto:' . $email . '">Email Committee Members</a></p>';

					?>
				</div>
				<div class="unit-3-5 unit-1-1-md">
					<div class="grid">

						<?php
						$members = get_field('committee_members');
						foreach($members as $member):
							$user_data = sgfc_prep_user_data($member);
							?>
							<div class="unit-1-3 unit-1-2-sm text-center">
								<p><a href="<?php echo $user_data['link'] ?>"><img class="full rounded" src="<?php echo $user_data['image'] ?>" /></a></p>
								<h4 class="clean"><a href="<?php echo $user_data['link'] ?>"><?php echo $user_data['name'] ?></a></h4>
								<p><?php echo $user_data['subtitle'] ?></p>
							</div>
							<?php
						endforeach;
						?>

					</div>
				</div>
			</div>
		</article>
	</section>
	<?php
	$is_alt = !$is_alt;

endwhile;

wp_reset_query();

get_footer();