<?php

add_filter('robots_txt', 'hardcoded_robots_content', 10000, 2);

function hardcoded_robots_content($rv, $public)
{
  $content = <<<TXT
User-agent: *
Disallow: /wp-admin/
Disallow: /wp-includes/
TXT;
  
  $rv = esc_attr(strip_tags($content));

  return $rv;
}