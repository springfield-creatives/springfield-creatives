<?php
/*
Template Name: Business & Organization Directory
 */

get_header();
the_post();

$empty_search_query = count($_GET) == 0;
if(!$empty_search_query)
  $hero_intro = false;

require('partial-hero.php');

if(get_field('type') == 'businesses'){

  $post_type_data = array(
    'singular' => 'Business',
    'plural' => 'Businesses',
    'tax' => array(
      'wp_tax_name' => 'industry',
      'label' => 'Industry',
      'query_name' => 'business_industry'
    )
  );

}else{

  $post_type_data = array(
    'singular' => 'Organization',
    'plural' => 'Organizations',
    'tax' => array(
      'wp_tax_name' => 'organization-type',
      'label' => 'Organization Type',
      'query_name' => 'business_org_type'
    )
  );

}

?>

<section class="inverse thin">
  <article>
    
    <?php
    if(!$empty_search_query):
      ?>
      <h4 class="clean text-center"><a class="toggle" href="">Find A <?php echo $post_type_data['singular'] ?> <i class="fa fa-angle-down"></i></a></h4>
      <?php
    endif;
    ?>

    <div class="collapsible" <?php echo $empty_search_query ? 'data-open' : '' ?>>
      <div class="grid margin-double">
        <div class="margin"></div>
        <div class="unit-1-2 unit-1-1-sm margin">
          <form>
            <h3>Find A <?php echo $post_type_data['singular'] ?></h3>
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
          <h3>or, Narrow By <?php echo $post_type_data['tax']['label'] ?></h3>
          <?php
          $industry = get_terms(array(
            'taxonomy' => $post_type_data['tax']['wp_tax_name'],
            'hide_empty' => true
          ));
          ?>
          <form>
            <div class="grid margin-half">
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
                    <input id="label-<?php echo $ind_count ?>" type="checkbox" name="<?php echo $post_type_data['tax']['query_name'] ?>[]" value="<?php echo $cur_ind->slug ?>" <?php echo !empty($_GET[ $post_type_data['tax']['query_name'] ]) && in_array($cur_ind->term_id, $_GET[ $post_type_data['tax']['query_name'] ]) ? 'checked ' : '' ?>/>
                    <label for="label-<?php echo $ind_count ?>"><?php echo ucfirst($cur_ind->name) ?></label>
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

$business_results = sgfc_get_business_results(get_field('type'));



if(!empty($business_results) && !empty($business_results['results_featured'])):
  ?>
  <?php
        foreach($business_results['results_featured'] as $business):
  echo '<section class="alt thin margin-half">';
    echo '<article>';
      echo '<div class="grid">';
          render_directory_item($business, true);
      echo '</div>';
    echo '</article>';
  echo '</section>';
  endforeach;
  ?>
  <?php
endif;

if(!empty($business_results) && !empty($business_results['results_reg'])):
  ?>
  <section>
    <article>
      <div class="grid small">
        <?php
        foreach($business_results['results_reg'] as $business):
          render_directory_item($business, false, sgfc_is_sponsor($business));
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