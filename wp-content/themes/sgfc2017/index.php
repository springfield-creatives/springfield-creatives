<?php
get_header();

$no_hero = false;


// What type of page is this?
if(function_exists('is_account_page') && is_account_page()){

  $no_hero = true;
  $is_single = true;

}else if(is_home() || is_archive()){

  $updates_page_id =  get_option( 'page_for_posts' );
  $hero_title = get_field('hero_text', $updates_page_id);
  $hero_img = get_field('hero_image', $updates_page_id);
  $hero_intro = get_field('hero_intro', $updates_page_id);
  $buttons = get_field('hero_buttons', $updates_page_id);

}

// herotown, USA
if(!$no_hero){
  require('partial-hero.php');
} else {
  ?>
  <div class="hero-buffer"></div>
  <?php
}
?>
<section>
  <article>
    <?php
    if($is_single){

      the_content();

    }else{

      ?>
      <div class="grid">
        <div class="unit-3-4 unit-1-1-md margin">

          <?php
          while(have_posts()): the_post();

            $image = get_object_image_src(get_the_ID(), 'post', 'square');
            ?>

            <div class="grid small">
                <div class="unit-1-4 unit-1-1-sm">
                    <p><a href="<?php the_permalink() ?>"><img src="<?php echo $image ?>" /></a></p>
                </div>
                <div class="unit-3-4 unit-1-1-sm">
                    <p class="callout clean"><?php echo get_the_date() ?></p>
                    <h3 class="clean"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                    <p><?php the_author() ?></p>
                    <?php the_excerpt() ?> <a href="<?php the_permalink() ?>">Continue Reading</a>
                </div>
            </div>
            <hr />

            <?php
          endwhile;
          ?>

          <div class="text-center">
              <h4>
                <?php
                parse_str($_SERVER['QUERY_STRING'], $query_string);

                $cur_page = isset($_GET['paged']) ? intval($_GET['paged']) : get_query_var('paged');
                if(empty($cur_page))
                  $cur_page = 1;

                if($cur_page > 1){
                  $query_string['paged'] = $cur_page - 1;
                  echo '<a class="left" href="?' . http_build_query($query_string) . '">← Previous</a>';
                }

                for($i = 1; $i <= $wp_query->max_num_pages; $i++){
                  if($i==$cur_page){
                    echo '<strong>' . $i . '</strong> ';
                  }else{
                    $query_string['paged'] = $i;
                    echo '<a href="?' . http_build_query($query_string) . '">' . $i . ' </a>';
                  }
                }

                if($cur_page != $wp_query->max_num_pages){
                  $query_string['paged'] = $cur_page + 1;
                  echo '<a class="right" href="?' . http_build_query($query_string) . '">Next →</a>';
                }  
                ?>      

              </h4>
          </div>

        </div>
        
        <div class="unit-1-4 unit-1-1-md">
          <?php require('partial-blog-sidebar.php'); ?>
        </div>
      
      </div>

      <?php
    }
    ?>
    </div>
  </article>
</section>
<?php
get_footer();
?>