<?php
/* Template Name: LaborOnline */

 // Turns off AutoP for these pages
remove_filter('the_content', 'wpautop');
wp_enqueue_script('masonry', 'https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js', array(), '1.0.0', true );
wp_enqueue_script('imagesloaded', 'https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js', array(), null, true );

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
      var author_grid = document.querySelector('#authors-grid')
      imagesLoaded(author_grid, function(instance) {
        var msnry = new Masonry(author_grid, {
            // options
            itemSelector: '.an-author-box',
            columnWidth: 32,
            gutter: 5,
            fitWidth: true,
            percentPosition: true,
            resize: false,
            transitionDuration: '0.2s'
        });
      });
    };
  </script>

<?php get_footer(); ?>
