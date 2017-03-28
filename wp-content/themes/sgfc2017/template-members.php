<?php
/*
Template Name: Members Directory
 */

get_header();
the_post()
?>

<section class="hero overlay" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/media/images/hero.jpg);">
  <article>
    <h1 class="margin text-center"><?php the_title() ?></h1>
    <div class="grid grid-center">
      <div class="unit-2-3 unit-1-1-md text-center">
        <?php the_field('intro') ?>
      </div>
    </div>
  </article>
</section>
<section class="inverse thin">
  <article>
    <h4 class="clean text-center"><a class="toggle" href="">Refine Results <i class="fa fa-angle-down"></i></a></h4>
    <div class="collapsible">
      <div class="grid margin-double">
        <div class="margin"></div>
        <div class="unit-1-2 unit-1-1-sm margin">
          <form>
            <h3>Find A Member</h3>
            <label>
              <input type="text" placeholder="First Name" />
            </label>
            <label>
              <input type="text" placeholder="Last Name" />
            </label>
            <label>
              <input type="text" placeholder="Employer" />
            </label>
            <label>
              <input type="text" placeholder="Keyword" />
            </label>
            <label class="select">
              <select>
                <option>Committee</option>
                <option>Committee Name</option>
                <option>Committee Name</option>
                <option>Committee Name</option>
                <option>Committee Name</option>
              </select>
            </label>
            <button>Search</button>
          </form>
        </div>
        <div class="unit-1-2 unit-1-1-sm">
          <h3>or, Narrow By Trade</h3>
          <form>
            <div class="grid">
              <div class="unit-1-2 unit-1-1-lg">
                <div class="checkbox">
                  <input id="label-1" type="checkbox" />
                  <label for="label-1">Photography App Development</label>
                </div>
                <div class="checkbox">
                  <input id="label-2" type="checkbox" />
                  <label for="label-2">Graphic Design Illustration</label>
                </div>
                <div class="checkbox">
                  <input id="label-3" type="checkbox" />
                  <label for="label-3">Web Design Craftsmaking</label>
                </div>
                <div class="checkbox">
                  <input id="label-4" type="checkbox" />
                  <label for="label-4">Web Development Art Direction</label>
                </div>
                <div class="checkbox">
                  <input id="label-5" type="checkbox" />
                  <label for="label-5">Copywriting Videography</label>
                </div>
                <div class="checkbox">
                  <input id="label-6" type="checkbox" />
                  <label for="label-6">Marketing Motion Graphics</label>
                </div>
                <div class="checkbox">
                  <input id="label-7" type="checkbox" />
                  <label for="label-7">Branding Animation</label>
                </div>
              </div>
              <div class="unit-1-2 unit-1-1-lg">
                <div class="checkbox">
                  <input id="label-8" type="checkbox" />
                  <label for="label-8">Software Engineering Typography</label>
                </div>
                <div class="checkbox">
                  <input id="label-9" type="checkbox" />
                  <label for="label-9">Copywriting Videography</label>
                </div>
                <div class="checkbox">
                  <input id="label-10" type="checkbox" />
                  <label for="label-10">Marketing Motion Graphics</label>
                </div>
                <div class="checkbox">
                  <input id="label-11" type="checkbox" />
                  <label for="label-11">Branding Animation</label>
                </div>
                <div class="checkbox">
                  <input id="label-12" type="checkbox" />
                  <label for="label-12">Software Engineering Typography</label>
                </div>
                <div class="checkbox">
                  <input id="label-13" type="checkbox" />
                  <label for="label-13">Branding Animation</label>
                </div>
                <div class="checkbox">
                  <input id="label-14" type="checkbox" />
                  <label for="label-14">Software Engineering Typography</label>
                </div>
              </div>
            </div>
            <button>Filter</button>
          </form>
        </div>
      </div>
      <div class="text-center">
        <h3 class="margin"><a href="">A</a> <a href="">B</a> <a href="">C</a> <a href="">D</a> <a href="">E</a> <a href="">F</a> <a href="">G</a> <a href="">H</a> <a href="">I</a> <a href="">J</a> <a href="">K</a> <a href="">L</a> <a href="">M</a> <a href="">N</a> <a href="">O</a> <a href="">P</a> <a href="">Q</a> <a href="">R</a> <a href="">S</a> <a href="">T</a> <a href="">U</a> <a href="">V</a> <a href="">W</a> <a href="">X</a> <a href="">Y</a> <a href="">Z</a></h3>
        <p><a href="">View All</a></p>
      </div>
    </div>
  </article>
</section>
<section>
  <article>
    <div class="grid small">
      <div class="unit-1-3 unit-1-2-md unit-1-1-sm margin">
        <div class="grid">
          <div class="unit-1-3">
            <p><img class="full rounded" src="<?php echo get_stylesheet_directory_uri() ?>/media/images/placeholder.png" /></p>
          </div>
          <div class="unit-2-3">
            <h4>Adam Adams</h4>
            <p>Web Developer<br /><i>Bizzy Business</i><br /><a href="">View Profile</a> |<a href="">Email</a></p>
          </div>
        </div>
      </div>
    </div>
  </article>
</section>
<section class="inverse">
  <article class="text-center">
    <h3><?php the_field('business_dir_title') ?></h3>
    <p class="callout"><?php the_field('business_dir_cta') ?></p>
    <p><a class="button" href="<?php the_field('business_directory_url', 'options') ?>">Business Directory</a></p>
  </article>
</section>

<?php
get_footer();