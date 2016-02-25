<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 */

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

<article <?php post_class(); ?>>
	<div class="article-header<?php if($thumbnail > 599) { echo ' banner'; } ?><?php if($custom['lawcha_event'][0] == 'yes') { echo ' lawcha'; }?>" <?php if($thumbnail > 599) { ?> style="background-image:url(<?=$thumbnail_url?>);min-height:<?=$thumbnail_height?>px"<?php } ?>>
		<div class="details">
			<h2 class="event-title">
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
			<div class="event-details">
				<div class="when">
					<?=$custom['display_date'][0]?>
				</div>
				<div class="where">
					<?=$custom['location'][0]?>, <?=$custom['country'][0]?>
				</div>
			</div>
		</div>
	</div>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php if(!empty($custom['link'][0])) { ?>
			<p class="more-info">For more information, see <a href="<?=$custom['link'][0]?>">the official site for <?=$title?> &raquo;</a>
		<?php } ?>
	</div><!-- .entry-content -->
	
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

	<?php the_tags('<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>'); ?>
</article><!-- #post-## -->
