<?php
/*
Template Name: Meeting Check In
*/

if(!current_user_can('add_users'))
    die('You need to sign in first');

get_header();
the_post();



$args = array(
    'orderby' => "display_name",
    "order" => "asc"
);
$members = new WP_User_Query($args);

$members_sign_in = get_post_meta($_GET['event_id'], 'members_sign_in', true);

?>

<?php if (!empty($members->results)) : ?>
    <section class="main">
        <div class="middlifier">
            <table>
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Present?</td>
                </thead>
                <?php
                foreach ($members->results as $member) : 
                    echo '<tr>';

                    // name
                    echo '<td>' . $member->display_name . '</td>';

                    // present?
                    $present_checked = array_search($member->ID, $members_sign_in)!==false ? 'checked="checked" ' : '';
                    echo '<td><input type="checkbox" name="present" data-member-id="' . $member->ID . '" ' . $present_checked . '</td>';


                    // // paid?
                    // $paid_checked = get_user_meta($member->ID, 'paid') ? 'checked="checked" ' : '';
                    // echo '<td><input type="checkbox" data-member-id="' . $member->ID . '" ' . $paid_checked . '</td>';

                    echo '</tr>';
                endforeach;
                ?>
            </table>
        </div>
    </section>
<?php endif; ?>


<script>
    <?php
    if(!empty($_GET['event_id']))
        echo 'event_id = ' . $_GET['event_id'] . ';';

    echo 'ajaxUrl = "' . get_bloginfo('url') . '/wp-admin/admin-ajax.php";'
    ?>

    jQuery(function($){
        $('input[name="present"]').change(function(e){


            var $el = $(e.currentTarget),
                data = {
                    action: 'mark_member_present',
                    present: $el.is(':checked'),
                    memberID: $el.data('member-id'),
                    eventID: event_id
                };

            $.post(ajaxUrl, data, function(response) {
                console.log(response);
            });
            
        });

    });
</script>

<?php

get_footer();