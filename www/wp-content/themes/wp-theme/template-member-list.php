<?php
/*
Template Name: Members Listing
*/

get_header();
the_post();

include('partials/hero.php');

$args = array(
    'role' => array(
        'Administrator',
        'Member'
    ),
    'orderby' => "display_name",
    "order" => "asc"

);
$members = new WP_User_Query($args);
?>


<?php if (!empty($members->results)) : ?>
    <section class="main">
        <div class="middlifier">
            <ul class="post-list directory column-2">
                <?php
                foreach ($members->results as $member) : 
                    render_person_item($member);
                endforeach;
                ?>
            </ul>
        </div>
    </section>
<?php endif; ?>


<section class="wysiwyg">
    <div class="middlifier">
        <?php the_content() ?>
    </div>
</section>

<?php
get_footer();
?>