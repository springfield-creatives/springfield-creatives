<?php
/*
Template Name: Contact
 */

get_header();
the_post();

require('partial-hero.php');
?>
<section>
    <article>
        <div class="grid grid-center margin">
            <div class="unit-2-3 unit-1-1-md text-center">
                <h3>Contact Us</h3>
                <p class="callout margin-double"><?php the_field('callout') ?></p>
                <?php the_content() ?>
            </div>
        </div>
    </article>
</section>
<section class="alt">
    <article>
        <div class="grid grid-center margin">
            <div class="unit-2-3 unit-1-1-md text-center">
                <h3><?php the_field('newsletter_title') ?></h3>
                <p class="callout margin-double"><?php the_field('newsletter_callout') ?></p>
                <!-- Begin MailChimp Signup Form -->
                <div id="mc_embed_signup">
                  <form action="//springfieldcreatives.us8.list-manage.com/subscribe/post?u=645d119550cb6c335ea9f460e&amp;id=31b5e16871" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <div id="mc_embed_signup_scroll">
                      <div class="mc-field-group">
                        <label for="mce-EMAIL">
                          <input type="email" value="" placeholder="Email" name="EMAIL" class="required email" id="mce-EMAIL">
                        </label>
                      </div>
                      <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                      </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                      <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_645d119550cb6c335ea9f460e_31b5e16871" tabindex="-1" value=""></div>
                      <div class="clear"><button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" >Sign me up</button></div>
                    </div>
                  </form>
                </div>

                <!--End mc_embed_signup-->
            </div>
        </div>
    </article>
</section>

<?php require('partial-more-links.php'); ?>

<?php
get_footer();