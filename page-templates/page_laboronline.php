<?php
/* Template Name: LaborOnline */

 // Turns off AutoP for these pages
remove_filter('the_content', 'wpautop');
wp_enqueue_script('masonry', 'https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.1/masonry.pkgd.min.js', array(), '1.0.0', true );

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

  <script>
    window.onload = function() {
        var elem = document.querySelector('#authors-grid');
        var msnry = new Masonry( elem, {
            // options
            itemSelector: '.an-author-box',
            columnWidth: 64,
            gutter: 12,
            isFitWidth: true,
            transitionDuration: '0.2s'
        });
    };
  </script>

<?php get_footer(); ?>
