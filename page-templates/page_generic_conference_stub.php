<?php
/* Template Name: Generic Conference Stub Template */
/**
 * The template for displaying pages
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?= get_template_directory_uri() ?>/chicago-conference.css?2022-07-05-01" media="screen" />
  <link href='//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,700|Merriweather:400,400italic,700,700italic|Bitter:400,400italic,700' rel='stylesheet' type='text/css'>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-20056838-1', 'auto');
  ga('send', 'pageview');

</script>

  <?php wp_head(); ?>
</head>

<body <?php body_class("chicago-conference chicago-conference-stub"); ?>>
<div class="page-wrapper hfeed">
  <a class="skip-link screen-reader-text" href="#content"><?php echo 'Skip to content'; ?></a>

  <div class="header">
    <div class="inside-wrapper">

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

      <div class="conference-info">
        <h2 class="title">
          <a href="/annualmeeting/">
            <?=get_field("title")?>
            <?=get_field("location") ? "<span>" . get_field("subtitle") . "</span>" : ""?>
          </a>
        </h2>
      </div>

    </div>
  </div>

  <div id="content" class="content">

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();

      // Include the page content template.
      get_template_part('content', 'page');

    // End the loop.
    endwhile;
    ?>

    </main><!-- .site-main -->
  </div><!-- .content-area -->

<?php get_footer(); ?>
