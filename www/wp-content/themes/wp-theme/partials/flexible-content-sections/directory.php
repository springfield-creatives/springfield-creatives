<section id="charter-board-members" class="charter-board-members main">
	<div class="middlifier">
		<?php
		$title = get_sub_field('section_title');
		if(!empty($title))
			echo "<h2>$title</h2>";


		$intro = get_sub_field('section_intro_text');
		if(!empty($intro))
			echo "<p>$intro</p>";

		$dir_type = get_sub_field('directory_type');

		if($dir_type == 'members'){
			$render_func = 'render_person_item';
			$post_obj_name = 'directory_user_object';
		}else{
			$render_func = 'render_post_list_item';
			$post_obj_name = 'directory_post_object';
		}

		$dir_data = get_sub_field('directory_data');

		echo '<ul class="directory ' . $dir_type . ' column-2">';

		switch($dir_data){
			case 'specific':

				// name of ACF field
				$list_name = 'selected_' . $dir_type;
				if( have_rows($list_name) ):

					while( have_rows($list_name) ): the_row(); 

						// vars
						$dir_post_data = get_sub_field($post_obj_name);
						
						$title = get_sub_field('subtitle');

						call_user_func($render_func, $dir_post_data, $title);

					endwhile;

				endif;
			break;

			case 'recent':

					$num_to_show = get_sub_field('number_of_listing_items');

					// query recent posts/users/whatever
					if($dir_type == 'members'){
						$args = array(
						    'role' => array(
						        'Administrator',
						        'Member'
						    ),
						    'orderby' => "registered",
						    "order" => "desc",
						    "number" => $num_to_show
						);
						$members = new WP_User_Query($args);

		                foreach ($members->results as $member) : 
		                    render_person_item($member);
		                endforeach;

					}else{

						$dir_posts = new WP_Query(array(
							"post_type" => $dir_type,
							"posts_per_page" => $num_to_show
						));

						while( $dir_posts->have_posts() ) {
							$dir_posts->the_post();

							// render_post_list_item will use global $post by default					
							call_user_func($render_func);
		                }

						wp_reset_postdata();
						
					}

			break;
		}

		echo '</ul>';

		?>
	</div>
</section>