<?php
/*
Template Name: Business Directory
 */

get_header();
the_post();

require('partial-hero.php');
?>

<section class="inverse thin">
  <article>
    
    <?php
    if(!$empty_search_query):
      ?>
      <h4 class="clean text-center"><a class="toggle" href="">Refine Results <i class="fa fa-angle-down"></i></a></h4>
      <?php
    endif;
    ?>

    <div class="collapsible" <?php echo $empty_search_query ? 'data-open' : '' ?>>
      <div class="grid margin-double">
        <div class="margin"></div>
        <div class="unit-1-2 unit-1-1-sm margin">
          <form>
            <h3>Find A Business</h3>
            <label>
              <input type="text" placeholder="Name" name="business_name" value="<?php echo !empty($_GET['business_name']) ? $_GET['business_name'] : '' ?>" />
            </label>
            <label>
              <input type="text" placeholder="Keyword"  name="business_keyword" value="<?php echo !empty($_GET['business_keyword']) ? $_GET['business_keyword'] : '' ?>" />
            </label>
            <button>Search</button>
          </form>
        </div>
        <div class="unit-1-2 unit-1-1-sm">
          <h3>or, Narrow By Industry</h3>
          <?php
          $industry = get_terms(array(
            'taxonomy' => 'industry'
          ));
          ?>
          <form>
            <div class="grid">
              <div class="unit-1-2 unit-1-1-lg">
                <?php
                $ind_count = 0;
                $midpoint = round(count($industry)/2);
                foreach($industry as $ind => $cur_ind):
                
                  $ind_count++;

                  if($ind == $midpoint)
                    echo '</div><div class="unit-1-2 unit-1-1-lg">';

                  ?>
                  <div class="checkbox">
                    <input id="label-<?php echo $ind_count ?>" type="checkbox" name="business_industry[]" value="<?php echo $cur_ind->term_id ?>" <?php echo !empty($_GET['business_industry']) && in_array($cur_ind->term_id, $_GET['business_industry']) ? 'checked ' : '' ?>/>
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
            echo '<a href="?business_view=' . $letter . '">' . ucfirst($letter) . '</a> ';
          ?>
        </h3>
        <p><a href="?business_view=all">View All</a></p>
      </div>
    </div>
  </article>
</section>

<?php
if(!$empty_search_query){
  $business_results = sgfc_get_business_results('businesses');
}


if(!empty($business_results) && !empty($business_results['results_featured'])):
  ?>
  <section class="alt thin margin-half">
    <article>
      <div class="grid">
        <?php
        foreach($business_results['results_featured'] as $business):
          render_directory_item($business, true);
        endforeach;
        ?>
      </div>
    </article>
  </section>
  <?php
endif;

if(!empty($business_results) && !empty($business_results['results_reg'])):
  ?>
  <section>
    <article>
      <div class="grid small">
        <?php
        foreach($business_results['results_reg'] as $business):
          render_directory_item($business, false);
        endforeach;
        ?>
      </div>
    </article>
  </section>
  <?php
endif;
?>

<section class="inverse">
  <article class="text-center">
    <h3><?php the_field('membership_dir_title') ?></h3>
    <p class="callout"><?php the_field('membership_dir_cta') ?></p>
    <p><a class="button" href="<?php the_field('membership_directory_url', 'options') ?>">Members Directory</a></p>
  </article>
</section>

<?php
get_footer();