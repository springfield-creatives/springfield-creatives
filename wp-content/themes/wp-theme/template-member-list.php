<?php
/*
Template Name: Members Listing
*/

get_header();
the_post();

include('partials/hero.php');


// query and pagination
$number     = 36;
$paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset     = ($paged - 1) * $number;

$args = array(
    // 'role' => 'Member',
    'orderby' => "display_name",
    "order" => "asc",
    "number" => $number,
    "offset" => $offset
);

// if serach term is set, throw that mug in there
if(!empty($_GET['member-s'])){
    $args['search'] = '*' . $_GET['member-s'] . '*';
    $args['search_columns'] = array('user_email', 'display_name', 'user_nicename');
}

// if industry is set, filter by that too
if(!empty($_GET['filter-industry']) && $_GET['filter-industry'] != 'default'){
    $args['meta_key'] = 'industry';
    $args['meta_value'] = '"' . $_GET['filter-industry'] . '"';
    $args['meta_compare'] = 'LIKE';
}

// do the query
$members = new WP_User_Query($args);

$total_users = $members->total_users;
$total_query = count($members->results);
$total_pages = ceil($total_users / $number);


require('partials/search-filter.php');


if (!empty($members->results)) : ?>
    <section class="main">
        <ul class="directory column-3">
            <?php
            foreach ($members->results as $member) : 
                render_person_item($member);
            endforeach;
            ?>
        </ul>

        <?php
        // pagination
        if ($total_users > $total_query) {  
            echo '<nav id="pagination" class="pagination clearfix">';  
            $current_page = max(1, get_query_var('paged')); 
            if(isset($_GET['member-s'])){
                $base = ($_SERVER['HTTPS'] ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . '%_%';
                $format = '&paged=%#%';
            }else{
                $base = get_pagenum_link(1) . '%_%';
                $format = 'page/%#%/';
            }

            echo paginate_links(array(  
                'base' => $base,  
                'format' => $format,  
                'current' => $current_page,  
                'total' => $total_pages,  
                'prev_next'    => true,  
                'type'         => 'list',  
            ));  
            echo '</nav>'; 
        }
        ?>
    </section>
<?php endif; 


?>

<section class="wysiwyg">
    <div class="middlifier">
        <?php the_content() ?>
    </div>
</section>

<?php 
get_footer();
?>