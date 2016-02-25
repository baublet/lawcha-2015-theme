<?php
/**
 * The default template for displaying post previews
 *
 * Used for archive pages
 *
 */

 $newclasses = array('post-preview');
 if(has_post_thumbnail()) $newclasses[] = 'has-thumb';
 
 // Setup the post thumbnail
 $thumbnail = 0;
 if(has_post_thumbnail()) {
 	$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
 	$thumbnail = $img[1];
 	$thumbnail_url = $img[0];
 	$thumbnail_height = $img[2];
 }

 $custom = get_post_custom();
 
 ?>
 <article <?php post_class($newclasses); ?>>
	<?php if(has_post_thumbnail()): ?>
		<div class="thumb-box">
			<a href="<?=get_permalink()?>"><?php the_post_thumbnail('medium', $attr); ?></a>
		</div>
	<?php endif; ?>
	<h2><a href="<?=get_permalink()?>"><?=the_title()?></a></h2>
	<div class="meta">
		Posted on <span class="date"><?=get_the_date()?></span>
	</div>
    <div class="event-details">
        <div class="when">
            <?=$custom['display_date'][0]?>
        </div>
        <div class="where">
            <?=$custom['location'][0]?>, <?=$custom['country'][0]?>
        </div>
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