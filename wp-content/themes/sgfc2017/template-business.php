<?php
/*
Template Name: Business Directory
 */

get_header();
the_post()
?>

<section class="hero overlay" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/media/images/hero.jpg);">
  <article>
    <h1 class="margin text-center"><?php the_title() ?></h1>
    <div class="grid grid-center">
      <div class="unit-2-3 unit-1-1-md text-center">
        <p class="margin-double"><?php the_field('intro') ?></p>
        <p><a class="button" href="">Feature Your Business</a> <a class="button" href="">Add Your Business</a></p>
      </div>
    </div>
  </article>
</section>
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
                $midpoint = round(count($industry)/2);
                foreach($industry as $ind => $cur_ind):
                  if($ind == $midpoint)
                    echo '</div><div class="unit-1-2 unit-1-1-lg">';

                  ?>
                  <div class="checkbox">
                    <input id="label-1" type="checkbox" name="business_industry[]" value="<?php echo $cur_ind->term_id ?>" <?php echo !empty($_GET['business_industry']) && in_array($cur_ind->term_id, $_GET['business_industry']) ? 'checked ' : '' ?>/>
                    <label for="label-1"><?php echo $cur_ind->name ?></label>
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