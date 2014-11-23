<?php
/*
Template Name: Members
*/

get_header();
the_post();

include('partials/hero.php');

$args = array(
    'role' => array(
        'Administrator',
        'Member'
    ),
    'orderby' => "registered",
    "order" => "desc",
    "number" => 8
);
$members = new WP_User_Query($args);
?>


<?php if (!empty($members->results)) : ?>
    <section class="main">
        <div class="middlifier">
            <h2>Newest Members</h2>
            <ul class="directory column-2">
                <?php
                foreach ($members->results as $member) : 
                    render_member_item($member);
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