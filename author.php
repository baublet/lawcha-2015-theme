<?php
/**
 * The template for displaying Author archive pages
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

/* Load the current author */
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $_GET['author_name']) : get_userdata(intval($author));

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main author-page" role="main">
			<div class="userphoto"><?=get_avatar($curauth->user_email,512)?></div>
			<h1 class="article-title">
				<span class="subtitle">posts and bio</span>
				<?=$curauth->display_name?>
			</h1>
			
			<div class="profile">
				<?php /* if(get_query_var('paged') < 2): ?>
					<div class="userphoto"><?=get_avatar(get_the_author_meta('email'),512)?></div>
				<?php endif; */ ?>
				<div class="bio short"><?=get_the_author_meta('affiliation', $curauth->ID)?></div>
				<?php if(get_query_var('paged') < 2): ?>
					<?php if(get_the_author_meta('user_url', $curauth->ID)) : ?><h3>Website</h3> <div class="website"><a style="text-wrap:unrestricted" href="<?=get_the_author_meta('user_url', $curauth->ID)?>"><?=htmlentities(str_replace(array("http://", "https://","www."), '', get_the_author_meta('user_url', $curauth->ID)))?></a></div><?php endif; ?>
					<?php $description = wpautop(wptexturize(get_the_author_meta('description', $curauth->ID))); ?>
					<?=((!empty($description)) ? '<h3>About</h3> <div class="bio long">' . $description . '</div>' : '')?>
				<?php endif; ?>
			</div>
			<hr>
			<?=$pagination?>
			<div class="author-posts">
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