<section class="inverse">
    <article class="text-center">
        <h3><?php the_field('more_section_title') ?></h3>
        
        <p class="callout">
          <?php
          $link_html_els = array();
          $more_links = get_field('more_section_links');
          foreach($more_links as $link)
            $link_html_els[] = '<a href="' . $link['url'] . '">' . $link['title'] . '</a>';

          echo join(' | ', $link_html_els);
          ?>
        </p>
        
    </article>
</section>