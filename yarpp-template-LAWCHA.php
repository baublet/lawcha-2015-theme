<?php 
/*
Template Name: LAWCHA Related Posts
Author: Ryan Poe
Description: LAWCHA's related post template for YARPP
*/
if (have_posts()):?>
<div class="related-posts">
	<ul>
		<li class="first">
			<h3>Looking for More?</h3>
			<p>Did this article whet your intellectual appetite? Check out some other posts that may also be of interest to you.</p>
		</li>
		<?php while (have_posts()) : the_post(); ?>
		<li>
			<h3 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo strip_tags(get_the_title()) . " \n"; ?><?php the_author(); ?> on <?php the_date(); ?>"><?php the_title(); ?></a></h3>
			<div class="excerpt"><?php echo strip_tags(get_the_excerpt()); ?></div>
			<div class="meta">By <span class="author"><?php the_author(); ?></span> on <span class="date"><?php echo get_the_date(); ?></span> (<?php comments_number( 'No responses', 'One response', '% responses' ); ?>)</div>
		</li>
		<?php endwhile; ?>
	</ul>
</div>
<?php endif; ?>