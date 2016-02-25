<?php
/**
 * The template for displaying Archive pages
 */

get_header();

global $wp_query;

// Redo the main query to sort by the event date
$args = array(
   'meta_key' => 'date',
   'orderby' => 'meta_value'
);
query_posts(
	array_merge(
		$wp_query->query,
		$args
	)
);

$big = 999999999; // need an unlikely integer
$pagination = paginate_links(array(
	'base' => str_replace($big, '%#%', esc_url( get_pagenum_link($big))),
	'format' => '?paged=%#%',
	'current' => max(1, get_query_var('paged')),
	'total' => $wp_query->max_num_pages,
	'before_page_number' => '<span class="screen-reader-text">Page </span>'
));
$pagination = '<div class="pagination">' . $pagination . '</div>';

?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main author-page" role="main">
			<h1 class="article-title">
				Events
			</h1>
			<?=$pagination?>
			<div class="archive-posts">
				<?php
					// Start the Loop.
					while (have_posts()) : the_post();
						get_template_part('post', 'event-preview');
					endwhile;
				?>
			</div>
			<?=$pagination?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_footer(); ?>