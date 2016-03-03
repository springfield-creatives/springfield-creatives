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
          <!-- Append "current" class to links for active state -->
          <ul class="primary">
            <li>
              <a href="">About Us</a>
              <ul>
                <li><a href="">Events</a></li>
                <li><a href="">Board</a></li>
                <li><a href="">Committees</a></li>
                <li><a href="">Handbook</a></li>
                <li><a href="">Blog</a></li>
              </ul>
            </li>          
            <li>
              <a href="">Directory</a>
              <ul>
                <li><a href="">Business Directory</a></li>
                <li><a href="">Members Directory</a></li>
              </ul>
            </li>       
            <li>
              <a href="">Jobs Board</a>
              <ul>
                <li><a href="">Post A Job</a></li>
              </ul>
            </li>         
            <li><a href="">Membership</a></li>
            <li><a href="">Sponsorship</a></li>
            <li><a class="button" href="">Become A Member</a></li>
          </ul>
          <ul class="secondary">
            <li><a href="">Blog</a></li>
            <li><a href="">Gear</a></li>
            <li><a href="">Login</a></li>
          </ul>
        </nav>
      </div>
    </header>