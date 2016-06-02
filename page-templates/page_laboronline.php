<?php
/* Template Name: LaborOnline */

 // Turns off AutoP for these pages
remove_filter('the_content', 'wpautop');

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main laboronline-page" role="main">

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
