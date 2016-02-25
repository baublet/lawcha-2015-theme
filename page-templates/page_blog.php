<?php
/* Template Name: Blog Page */
/**
 * The template for displaying blog pages, like the teaching committee
 */

// Turns off AutoP for these pages
remove_filter('the_content', 'wpautop');

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part('content', 'blog-page');

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>