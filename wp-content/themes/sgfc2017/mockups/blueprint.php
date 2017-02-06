<?php
  $page = 'Blue Print';
  include 'includes/header.php';
?>
<section class="hero overlay" style="background-image: url(media/images/hero.jpg);">
  <article>
    <h1>Hero Section With Overlay</h1>
  </article>
</section>
<section class="hero" style="background-image: url(media/images/hero.jpg);">
  <article>
    <div class="grid">
      <div class="unit-4-5 unit-center">
        <h1>Hero Section With Icon</h1>
      </div>
      <div class="unit-1-5 unit-center hidden-sm">
        <img class="full" src="/media/images/pencil.svg" />
      </div>
  </article>
</section>
<section class="alt">
  <article>
    <h3>Alernate Color Section</h3>
  </article>
</section>
<section>
  <article>
    <h3 class="margin-double">Typography</h3>
    <h1 class="margin">Heading 1</h1>
    <h2 class="margin">Heading 2</h2>
    <h3 class="margin">Heading 3</h3>
    <h4 class="margin">Heading 4</h4>
    <p>Paragraph text lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vitae placerat massa, quis aliquam nibh. Praesent malesuada a mi et dictum. Vivamus non nulla lacus. Nunc quis volutpat arcu. Curabitur volutpat nisi in tortor posuere, euismod mattis dolor iaculis. Nulla vel ornare tellus. In sollicitudin vestibulum odio, vel auctor nunc finibus non. Cras quis tortor eu massa mattis blandit. Mauris ultrices ligula turpis. Sed cursus feugiat ex in sollicitudin. Donec interdum tortor maximus maximus laoreet.</p>
    <p class="callout">Callout Paragraph text lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vitae placerat massa, quis aliquam nibh. Praesent malesuada a mi et dictum. Vivamus non nulla lacus. Nunc quis volutpat arcu. Curabitur volutpat nisi in tortor posuere, euismod mattis dolor iaculis. Nulla vel ornare tellus. In sollicitudin vestibulum odio, vel auctor nunc finibus non. Cras quis tortor eu massa mattis blandit. Mauris ultrices ligula turpis. Sed cursus feugiat ex in sollicitudin. Donec interdum tortor maximus maximus laoreet.</p>
    <p>Nullam id massa porta, faucibus nisl sit amet, luctus metus. Nam non maximus justo. Vestibulum finibus elementum erat eu tincidunt. Donec at arcu blandit, maximus ligula in, rhoncus justo. Morbi molestie consequat vestibulum. Maecenas ultrices ac risus a bibendum. Maecenas gravida, lorem at laoreet dictum, erat nulla commodo risus, sit amet ullamcorper nisi tortor sed augue. Maecenas vel ultricies velit, quis vestibulum mi. Integer iaculis dui ac felis sagittis, dapibus maximus dui rutrum. Suspendisse quis arcu libero. Phasellus aliquet bibendum neque, semper accumsan felis tempus non. Morbi tempus, elit placerat dignissim accumsan, est dui eleifend dolor, ac feugiat quam mi quis eros. Ut quis nunc non felis placerat convallis. Cras vitae est eget ante sodales malesuada. Etiam semper neque sit amet magna malesuada, a volutpat sapien lacinia.</p>
    <ul>
      <li>Unordered List Item</li>
      <li>Unordered List Item</li>
      <li>Unordered List Item</li>
      <li>Unordered List Item</li>
      <li>Unordered List Item</li>
    </ul>
    <ol>
      <li>Unordered List Item</li>
      <li>Unordered List Item</li>
      <li>Unordered List Item</li>
      <li>Unordered List Item</li>
      <li>Unordered List Item</li>
    </ol>
    <p><a class="button" href="">Example Button</a></p>
    <form>
      <label>
        <input type="text" />
      </label>
    </form>
  </article>
</section>

<?php
  include 'includes/footer.php';
?>