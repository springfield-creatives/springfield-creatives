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
        'Member',
        'Subscriber',
        'Contributor',
        'Author',
        'Editor'
    )
);
$members = new WP_User_Query($args);

?>

<section class="wysiwyg">
    <div class="middlifier">
        <?php the_content() ?>
    </div>
</section>

<?php if (!empty($members->results)) : ?>
    <section class="post page">
        <div class="middlifier">
            <ul class="directory column-2">
                <?php foreach ($members->results as $member) : ?>
                    <?php render_member_item($member); ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
<?php endif; ?>

<section class="contact">
	<header>
		<h2>Become a Member</h2>
	</header>
	<article>
		<?php gravity_form('Member Signup', false, true); ?>
	</article>
</section>

<?php
get_footer();
?>