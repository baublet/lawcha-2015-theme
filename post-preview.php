<?php
/**
 * The default template for displaying post previews
 *
 * Used for archive pages
 *
 */
 $otherauthors = get_post_custom_values('OtherAuthor', get_the_ID());
 if(!is_array($otherauthors)) {
 	$otherauthors = false;
 }
 $newclasses = array('post-preview');
 if(has_post_thumbnail()) $newclasses[] = 'has-thumb';
 ?>
 <article <?php post_class($newclasses); ?>>
	<?php if(has_post_thumbnail()): ?>
		<div class="thumb-box">
			<a href="<?=get_permalink()?>"><?php the_post_thumbnail('thumbnail'); ?></a>
		</div>
	<?php endif; ?>
	<h2><a href="<?=get_permalink()?>"><?=the_title()?></a></h2>
	<div class="meta">
		by <span class="name"><?php the_author_posts_link(); ?></span><?php 
			if($otherauthors) {
				foreach($otherauthors as $key => $author_id) { ?>, <span class="name"><a rel="author" href="<?=get_author_posts_url($author_id)?>" title="Posts by <?=get_the_author_meta('display_name',$author_id)?>"><?=get_the_author_meta('display_name',$author_id)?></a></span><?php }
			}
		?> on <span class="date"><?=get_the_date()?></span>
	</div>
	<?php
		$excerpt = get_the_excerpt();
		if(!empty($excerpt)): ?>
			<div class="excerpt">
				<?=$excerpt?> <a href="<?=get_permalink()?>" class="readmore">Read more &rarr;</a>
			</div>
	<?php
		endif;
	?>
 </article>