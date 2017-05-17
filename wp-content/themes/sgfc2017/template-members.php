<?php
/*
Template Name: Members Directory
 */

get_header();
the_post();

$empty_search_query = count($_GET) == 0;
if(!$empty_search_query)
  $hero_intro = false;

require('partial-hero.php');
?>

<section class="inverse thin">
  <article>
    
    <?php
    if(!$empty_search_query):
      ?>
      <h4 class="clean text-center"><a class="toggle" href="">Find A Member <i class="fa fa-angle-down"></i></a></h4>
      <?php
    endif;
    ?>

    <div class="collapsible" <?php echo $empty_search_query ? 'data-open' : '' ?>>
      <div class="grid margin-double">
        <div class="margin"></div>
        <div class="unit-1-2 unit-1-1-sm margin">
          <form action="<?php the_field('membership_directory_url', 'options') ?>">
            <h3>Member Search</h3>
            <label>
              <input type="text" placeholder="First Name" name="member_fname" value="<?php echo !empty($_GET['member_fname']) ? $_GET['member_fname'] : '' ?>" />
            </label>
            <label>
              <input type="text" placeholder="Last Name" name="member_lname" value="<?php echo !empty($_GET['member_lname']) ? $_GET['member_lname'] : '' ?>" />
            </label>
            <label style="display: none">
              <input type="text" placeholder="Employer" name="member_employer" value="<?php echo !empty($_GET['member_employer']) ? $_GET['member_employer'] : '' ?>" />
            </label>
            <label>
              <input type="text" placeholder="Keyword" name="member_keyword" value="<?php echo !empty($_GET['member_keyword']) ? $_GET['member_keyword'] : '' ?>" />
            </label>
            <label class="select">
              <select name="member_availability" >
                <option value="">Any Availability</option>
               
                <?php
                $field_key = SGFC_AVAILABILITY_ACF_KEY;
                $field = get_field_object($field_key);
                
                foreach( $field['choices'] as $k => $v ):

                  $selected = '';
                  if(!empty($_GET['member_availability']) && $_GET['member_availability'] == $k)
                    $selected = 'selected';

                  echo '<option name="' . $k . '" ' . $selected . '>' . $v . '</option>';

                endforeach;
                ?>
              </select>
            </label>
            <label class="select">
              <select name="member_committee" >
                <option value="">Any Committee</option>
                <?php
                $committees = new WP_Query(array(
                  'post_type' => 'committee',
                  'posts_per_page' => -1,
                  'orderby' => 'title',
                  'order' => 'asc'
                ));
                while($committees->have_posts()): $committees->the_post();
                  
                  $selected = '';
                  if(!empty($_GET['member_committee']) && $_GET['member_committee'] == get_the_ID())
                    $selected = 'selected';

                  echo '<option name="' . get_the_ID() . '" ' . $selected . '>' . get_the_title() . '</option>';

                endwhile;
                ?>
              </select>
            </label>
            <button>Search</button>
          </form>
        </div>
        <div class="unit-1-2 unit-1-1-sm">
          <h3>or, Narrow By Skillset</h3>
          <?php
          $industry = get_terms(array(
            'taxonomy' => 'skills',
            'hide_empty' => 0
          ));
          ?>
          <form action="<?php the_field('membership_directory_url', 'options') ?>">
            <div class="grid margin-half">
              <div class="unit-1-2 unit-1-1-lg">
                <?php
                $midpoint = round(count($industry)/2);
                $ind_count = 0;
                foreach($industry as $ind => $cur_ind):
                
                  $ind_count++;

                  if($ind == $midpoint)
                    echo '</div><div class="unit-1-2 unit-1-1-lg">';

                  ?>
                  <div class="checkbox">
                    <input id="label-<?php echo $ind_count ?>" type="checkbox" name="member_industry[]" value="<?php echo $cur_ind->term_id ?>" <?php echo !empty($_GET['member_industry']) && in_array($cur_ind->term_id, $_GET['member_industry']) ? 'checked ' : '' ?>/>
                    <label for="label-<?php echo $ind_count ?>"><?php echo $cur_ind->name ?></label>
                  </div>
                <?php
                endforeach;
                ?>
              </div>
            </div>
            <button>Filter</button>
          </form>
        </div>
      </div>
      <div class="text-center">
        <h3 class="margin">
          <?php
          $abc = 'abcdefghijklmnopqrstuvwxyz';
          $abc = str_split($abc, 1);
          foreach($abc as $letter)
            echo '<a href="?member_view=' . $letter . '">' . ucfirst($letter) . '</a> ';
          ?>
        </h3>
        <p><a href="?member_view=all">View All</a></p>
      </div>
    </div>
  </article>
</section>
<section>
  <article>
    <div class="grid small">
      <?php
        $member_results = sgfc_get_member_results();

        if(empty($member_results['results'])){
          echo '<div class="unit-1-1 text-center"><h4>No members found that match your criteria.</h4></div>';
        }else{
          foreach($member_results['results'] as $member):
            render_person_item($member);
          endforeach;
        }
      ?>
    </div>

    <?php
    if($member_results['pages'] > 1):
      ?>
      <hr />
      <div class="text-center">
        <h3>
          <?php
          parse_str($_SERVER['QUERY_STRING'], $query_string);

          $cur_page = isset($_GET['paged']) ? intval($_GET['paged']) : get_query_var('paged');
          if(empty($cur_page))
            $cur_page = 1;

          if($cur_page > 1){
            $query_string['paged'] = $cur_page - 1;
            echo '<a class="left" href="?' . http_build_query($query_string) . '">← Previous</a>';
          }

          for($i = 1; $i <= $member_results['pages']; $i++){
            if($i==$cur_page){
              echo '<strong>' . $i . '</strong> ';
            }else{
              $query_string['paged'] = $i;
              echo '<a href="?' . http_build_query($query_string) . '">' . $i . ' </a>';
            }
          }
          
          if($cur_page != $member_results['pages']){
            $query_string['paged'] = $cur_page + 1;
            echo '<a class="right" href="?' . http_build_query($query_string) . '">Next →</a>';
          }  
          ?>      
        </h3>
      </div>
      <?php
    endif;
    ?>
  </article>
</section>
<section class="inverse">
  <article class="text-center">
    <h3><?php the_field('business_dir_title') ?></h3>
    <p class="callout"><?php the_field('business_dir_cta') ?></p>
    <p><a class="button" href="<?php the_field('business_directory_url', 'options') ?>">Business Directory</a></p>
  </article>
</section>

<?php
get_footer();