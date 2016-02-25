<?php
/**
 * The template for displaying Archive pages
 */

get_header();

global $wp_query;

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
				<?php
					if (is_day()) {
						echo '<span class="subtitle">posts from</span>'
								. get_the_date();
					} elseif (is_month()) {
						echo '<span class="subtitle">posts from</span>'
								. get_the_date('F Y');

					} elseif (is_year()) {
						echo '<span class="subtitle">posts from the year</span>'
								. get_the_date('Y');
					} elseif(is_category()) {
						echo '<span class="subtitle">posts categorized as</span>'
								. single_cat_title('', false);
					} elseif(is_tag()) {
						echo '<span class="subtitle">posts tagged as</span>'
								. single_tag_title('', false);
					}
				?>
			</h1>
			<?=$pagination?>
			<div class="archive-posts">
				<?php
					// Start the Loop.
					while (have_posts()) : the_post();
						get_template_part('post', 'preview');
					endwhile;
				?>
			</div>
			<?=$pagination?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_footer(); ?>