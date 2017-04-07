<?php
/*
Template Name: Post a Job
 */

get_header();
the_post();

require('partial-hero.php');
?>
<section>
  <article>
    <h2 class="margin text-center">Post A Job</h2>
    <div class="grid grid-center margin-double">
      <div class="unit-2-3 unit-1-1-md text-center">
        <p class="callout"><?php the_field('intro') ?></p>
      </div>
    </div>
    <form>
      <div class="margin">
        <h3>Basic Info</h3>
        <div class="grid">
          <div class="unit-1-2 unit-1-1-sm">
            <label>
              <input type="text" placeholder="Position/Title" />
            </label>
          </div>
          <div class="unit-1-2 unit-1-1-sm">
            <label>
              <select>
                <option></option>
              </select>
            </label>
          </div>
        </div>
        <div class="grid">
          <div class="unit-1-5 unit-1-3-md unit-1-1-sm">
            <div class="checkbox">
              <input id="label-1" type="checkbox">
              <label for="label-1">Full Time</label>
            </div>
          </div>
          <div class="unit-1-5 unit-1-3-md unit-1-1-sm">
            <div class="checkbox">
              <input id="label-2" type="checkbox">
              <label for="label-2">Part Time</label>
            </div>
          </div>
          <div class="unit-1-5 unit-1-3-md unit-1-1-sm">
            <div class="checkbox">
              <input id="label-3" type="checkbox">
              <label for="label-3">Internship</label>
            </div>
          </div>
          <div class="unit-1-5 unit-1-3-md unit-1-1-sm">
            <div class="checkbox">
              <input id="label-4" type="checkbox">
              <label for="label-4">Contract</label>
            </div>
          </div>
          <div class="unit-1-5 unit-1-3-md unit-1-1-sm">
            <div class="checkbox">
              <input id="label-5" type="checkbox">
              <label for="label-5">Single Project</label>
            </div>
          </div>
        </div>
      </div>
      <div class="margin">
        <h3>Description</h3>
        <p>Please include application instructions.</p>
        <label>
          <textarea rows="10" cols="10"></textarea>
        </label>
      </div>
      <div class="margin">
        <h3>Contact Info</h3>
        <p>For questions or inquiries about this job.</p>
        <div class="grid">
          <div class="unit-1-2 unit-1-1-sm">
            <label>
              <input type="text" placeholder="Name" />
            </label>
          </div>
          <div class="unit-1-2 unit-1-1-sm">
            <label>
              <input type="text" placeholder="Email Address" />
            </label>
          </div>
        </div>
      </div>
      <div class="margin">
        <h3>Posting Type</h3>
        <div class="grid">
          <div class="unit-1-3 unit-1-1-sm">
            <div class="radio">
              <input id="label2-1" type="radio" name="type">
              <label for="label2-1">Featured Post</label>
            </div>
            <p class="callout clean">$50</p>
            <p>With featured listings, your job will be displayed prominently at the top of the jobs board, with description text, a photo, and will also be emailed to all Springfield Creatives members, ensuring your job is displayed to the most targeted group of skilled creatives in the area.</p>
          </div>
          <div class="unit-1-3 unit-1-1-sm">
            <div class="radio">
              <input id="label2-2" type="radio" name="type">
              <label for="label2-2">Sponsor Post</label>
            </div>
            <p class="callout clean">Sponsors Only</p>
            <p>If your business is already a sponsor, all of your job posts will already be included as a featured post, with no additional charge.  If you’re not a sponsor, but would like to learn about supporting the group and getting free featured posts, you can become a sponsor today.</p>
          </div>
          <div class="unit-1-3 unit-1-1-sm">
            <div class="radio">
              <input id="label2-3" type="radio" name="type">
              <label for="label2-3">Basic Post</label>
            </div>
            <p class="callout clean">Free</p>
            <p>Basic job and application info, viewable on the jobs board only.</p>
          </div>
        </div>
      </div>
      <div class="text-center">
        <h3>Welp, that's everything!</h3>
        <button type="submit">Submit Job Listing</button>
      </div>
    </form>
  </article>
</section>

<?php
get_footer();