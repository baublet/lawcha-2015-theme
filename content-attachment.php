<?php
/**
 * The template for displaying posts in the Image post format
 */

$img = wp_get_attachment_image_src(get_the_ID(), 'full');
$thumbnail_width = $img[1];
$thumbnail_url = $img[0];
$thumbnail_size = size_format(filesize(get_attached_file(get_the_ID())));
$thumbnail_height = $img[2];
$thumbnail_caption = get_the_excerpt();

// Calculate the type
$thumbnail_type = 'square';
$ratio = $thumbnail_width / $thumbnail_height;
if($ratio > 1.1) {
	$thumbnail_type = 'portrait';
} elseif ($ratio < .9) {
	$thumbnail_type = 'skyscraper';
}

global $post;

?>

<article <?php post_class($thumbnail_type); ?>>

	<header class="entry-header">
		<div class="article-header">
			<div class="banner-wrapper">
				<?php the_attachment_link('', true); ?>
			</div>
			<div class="attachment-details">
				<h2 class="article-title">
					<?php
						$title = get_the_title();
						if(function_exists('loop_shortcode_title')) {
							echo loop_shortcode_title($title);
							echo loop_shortcode_subtitle(
								$title,
								'<span class="subtitle">'
								,'</span>'
							);
						} else {
							echo $title;
						}
					?>
				</h2>
				<div class="meta">
					Posted on <span class="date"><?=date("F j\<\s\u\p\>S\<\/\s\u\p\>", $post_time)?>, <?=date("Y", $post_time)?></span>
				</div>
				<div class="entry-content">
					<?php
						/* translators: %s: Name of current post */
						if(!empty($thumbnail_caption)) {
							echo '<span class="caption"><strong>Caption:</strong> ' . $thumbnail_caption . '</span>';
						}
						the_content();
					?>
				</div><!-- .entry-content -->
				<div class="data">
					<ul>
						<li><strong>Post:</strong> <a href="<?=get_permalink($post->post_parent)?>"><?=get_the_title($post->post_parent)?></a></li>
						<li><strong>Width:</strong> <?=$thumbnail_width?>px</li>
						<li><strong>Height:</strong> <?=$thumbnail_height?>px</li>
						<li><strong>File Size:</strong> <?=$thumbnail_size?></li>
						<li><strong>URL:</strong> <a href="<?=$thumbnail_url?>"><?=$thumbnail_url?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</header><!-- .entry-header -->
	
	<?php // Load the social media necessities
	$url = 'http';
	if ($_SERVER["HTTPS"] == "on") {
		$url .= "s";
	}
	$url .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	$url = urlencode($url);	?>
	<div class="social">
		<a href="http://www.facebook.com/sharer.php?u=<?=$url?>" class="icon-facebook"><span>Share on Facebook</span></a>
		<a href="http://twitter.com/share?url=<?=$url?>" class="icon-twitter"><span>Share on Twitter</span></a>
		<a href="https://plus.google.com/share?url=<?=$url?>" class="icon-google-plus"><span>Share on Google+</span></a>
		<a href="http://www.linkedin.com/shareArticle?mini=true&url={articleUrl}<?=$url?>" class="icon-linkedin"><span>Share on LinkedIn</span></a>
		<a href="http://www.reddit.com/submit?url=<?=$url?>" class="icon-reddit"><span>Share on Reddit</span></a>
		<a href="http://pinterest.com/pin/create/button/?url=<?=$url?>" class="icon-pinterest"><span>Pin This</span></a>
		<a href="mailto:?subject=Check+out+this+article+at+LAWCHA.com&body=Hey!+Check+out+this+great+article+at+the+Labor+and+Working-Class+History+Association:+<?=$url?>" class="icon-mail"><span>Share over Email</span></a>
		<a href="http://www.printfriendly.com/print?url=<?=$url?>" class="icon-printer"><span>Print this Article</span></a>
	</div>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->
