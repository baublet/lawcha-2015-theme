<?php 
	$classes = array('blog-page');
	$description = trim(get_post_meta(get_the_ID(), 'description', true));
	if(empty($description)) {
		$description = false;
	}
	$sidebar = trim(get_post_meta(get_the_ID(), 'sidebar_content', true));
	if(empty($sidebar)) {
		$sidebar = false;
	} else {
		$sidebar = do_shortcode($sidebar);
	}
	$image = get_post_meta(get_the_ID(), 'page_splash_image', true);
	$thumbnail = 0;
	$thumbnail_url = '';
	if($image) {
		$image = wp_get_attachment_image_src($image, 'full');
		$thumbnail = $image[1];
		$thumbnail_url = $image[0];
	} else {
		$image = false;
	}
	$color = trim(get_post_meta(get_the_ID(), 'color', true));
	if(empty($color) || !$color) $color = '#333';
?>

<article <?php post_class($classes); ?>>

	<header class="entry-header<?=($thumbnail > 600)?' banner':''?>"<?=($thumbnail > 600)?' style="background-image:url('.$thumbnail_url.');background-color:'.$color.'"':''?>>
		<div class="entry-meta">
			<h1 class="entry-title"><?=get_the_title()?></h1>
			<?=($description) ? "<div class=\"description\">{$description}</div>" : ''?>
		</div>
	</header><!-- .entry-header -->
	<div class="entry-content<?=($sidebar)?' has-sidebar':''?>">
		<?=($sidebar) ? "<div class=\"sidebar\">{$sidebar}</div>" : ''?>
		<?php the_content(); ?>
	</div>
</article>
