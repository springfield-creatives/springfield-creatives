<!DOCTYPE html>
<html>
  <head>
    <title>
      <?php
        if(isset($tertiarypage)) echo $tertiarypage . ' | ';
        if(isset($subpage)) echo $subpage . ' | ';
        echo $page;
      ?> | Springfield Creatives</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" />
    <link href="media/styles/screen.css" type="text/css" media="screen" rel="stylesheet" />
    <script src="media/scripts/jquery.js" type="text/javascript"></script>
    <script src="media/scripts/plugins.js" type="text/javascript"></script>
    <script src="media/scripts/global.js" type="text/javascript"></script>
    <script src="https://use.typekit.net/aih1pbt.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <!--[if lt IE 9]>
      <script src="/workspace/media/scripts/ie.js" type="text/javascript"></script>
    <![endif]-->
  </head>
  <body>
    <header>
      <span>
        <span></span>
      </span>
      <div>
        <h2><a href="">Springfield Creatives</a></h2>
        <nav>
          <a<?php if($subpage == 'Automation') echo ' class="current"'; ?> href="">About Us</a>             
          <a<?php if($subpage == 'Automation') echo ' class="current"'; ?> href="">Directory</a>           
          <a<?php if($subpage == 'Automation') echo ' class="current"'; ?> href="">Jobs Board</a>            
          <a<?php if($subpage == 'Automation') echo ' class="current"'; ?> href="">Project Board</a>
          <a class="button<?php if($subpage == 'Automation') echo ' current'; ?>" href="">Sign Up</a>
          <a<?php if($subpage == 'Automation') echo ' class="current"'; ?> href="">Log In</a>
        </nav>
      </div>
    </header>