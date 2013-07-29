<?php

require_once('functions.php');
$handle = array_key_exists('p', $_GET) && !empty($_GET['p']) ? $_GET['p'] : 'home';

?><!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>Flock Captial</title>
        <meta charset="utf-8">
        <meta name="description" content="html meta description">
        <meta name="keywords" content="html, meta, keywords" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <link rel="canonical" href="http://flock.ips/" />
        <link rel="Shortcut Icon" type="image/svg" href="g/flockinvest-logo-symbol.svg">

        <link rel="stylesheet" href="style.css" type="text/css">
        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/ie8.css" type="text/css" media="screen"><![endif]-->

        <script src="js/html5.js"></script>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery-ui-1.10.3.min.js"></script>
        <script src="js/jquery.ui.widget-combobox.js"></script>
        <?php /*script src="js/jquery.isotope.min.js"></script>*/ ?>
        <script src="js/fancybox/fancybox.min.js"></script>
        <script src="js/custom.js"></script>

    </head>
    <body onload="" class="<?php echo $handle; ?>">
<?php /*<div id="screen-width"><span></span>px</div>
<ul id="screen-size-label">
<li id="xxl">Very Large Display <span>1800px+</span></li>
<li id="xl">Large Display <span>1500—1799px</span></li>
<li id="l">Medium Display <span>1200—1499px</span></li>
<li id="m">Small Display <span>1001—1199px</span></li>
<li id="s">Tablets & landscape large smartphones <span>700—1000px</span></li>
<li id="xs">Large smartphones <span>470—699px</span></li>
<li id="xxs">Small smartphones <span>—469px</span></li>
</ul>*/ ?>

        <div id="wrap">
          <header id="masthead" class="<?php echo /*$handle!='home' ? */'mini'/*  : '' */; ?>">
            <div>
              <div id="logo">
                <div>
              <h1 itemprop="logo"><a href="/">Flock</a></h1>
                </div>
              </div>
          <nav>
            <div>
              <ul>
                <li><a href="?p=projects" <?php if (array_key_exists('p', $_GET) && ($_GET['p']=='projects' || $_GET['p']=='project')) echo 'class="current"' ?>>Investments</a></li>
                <li><a href="#">How It Works</a></li>
                <li><a href="sign-in.php?action=sign-up" class="sign-in fancybox.ajax">Sign Up</a></li>
                <li><a href="sign-in.php" class="sign-in fancybox.ajax">Log In</a></li>
                <li class="profile-badge <?php if (array_key_exists('p', $_GET) && $_GET['p']=='profile') echo 'current' ?>">
                  <a href="?p=dashboard" id="profile-badge">
                    <img class="front" src="img/kadri.png">
                    <div class="focus"></div>
                  </a>
                  <ul>
                    <li class="name">Kadri Liis Rääk</li>
                    <li><a href="?p=dashboard">Dashboard</a></li>
                    <li><a href="?p=investor&i=kadri">Profile</a></li>
                    <li><a href="#">Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <a id="expand"><i></i></a>
            </div>
      </header>
            <div id="main">
