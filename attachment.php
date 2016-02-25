<?php
/**
 * The template for displaying posts
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of posts and that
 * other "posts" on your WordPress site will use a different template.
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main type post" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part('content', get_post_type());

		// End the loop.
		endwhile;

		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>