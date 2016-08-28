<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,700|Merriweather:400,400italic,700,700italic|Bitter:400,400italic,700" rel="stylesheet" type="text/css">

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-20056838-1', 'auto');
    ga('send', 'pageview');

  </script>

  <?php lawcha_wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="page-wrapper hfeed">
  <a class="skip-link screen-reader-text" href="#content"><?php echo 'Skip to content'; ?></a>

  <div class="header">
    <header id="top" role="banner">
      <div class="brand">
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span><?php bloginfo( 'name' ); ?></span></a></h1>
        <h2><?php echo get_bloginfo( 'description', 'display' ); ?></h2>
      </div>
    </header>

    <div class="header-nav">
      <input type="checkbox" id="nav-toggle">
      <label for="nav-toggle" id="nav-toggle-label">Navigation</label>
      <?php wp_nav_menu( array('main' => 'Primary Menu' )); ?>
    </div>
  </div>

  <div id="content" class="content">
