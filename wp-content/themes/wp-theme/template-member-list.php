<?php
/*
Template Name: Members Listing
*/

get_header();
the_post();

include('partials/hero.php');

?>

<section class="wysiwyg">
    <div class="middlifier">
        <?php the_content() ?>
    </div>
</section>

<?php 

// query and pagination
$number     = 10;
$paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset     = ($paged - 1) * $number;
$users      = get_users();
$total_users = count($users);

$args = array(
    'role' => 'Member',
    'orderby' => "display_name",
    "order" => "asc",
    "number" => $number,
    "offset" => $offset
);
$members = new WP_User_Query($args);

$total_query = count($members->results);
$total_pages = intval($total_users / $number) + 1;

?>


<?php if (!empty($members->results)) : ?>
    <section class="main">
        <div class="middlifier">
            <ul class="directory column-2">
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
                echo paginate_links(array(  
                    'base' => get_pagenum_link(1) . '%_%',  
                    'format' => 'page/%#%/',  
                    'current' => $current_page,  
                    'total' => $total_pages,  
                    'prev_next'    => true,  
                    'type'         => 'list',  
                ));  
                echo '</nav>'; 
            }
            ?>
        </div>
    </section>
<?php endif; ?>

<?php
get_footer();
?>