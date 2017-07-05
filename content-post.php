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
}

$otherauthors = get_post_custom_values('OtherAuthor',get_the_ID());
if(!is_array($otherauthors)) {
  $otherauthors = false;
}

// Date archive links
$archive_year  = get_year_link('');
$archive_month = get_month_link('', '');
$post_time = get_the_time('U');

 /* If this is a LaborOnline post,
  load the last three posts there,
  excluding this one*/
if(post_is_in_descendant_category(25)):?>
<div class="sub-brand labor-online<?=($thumbnail > 599) ? ' banner' : ' nobanner' ?>">
  <div class="sub-brand-image">
    <h3><a href="/wordpress/laboronline/"><span class="screen-reader-text">LABORonline</span></a></h3>
  </div>
  <div class="previous">
    <?php
    $loopObject = new WP_Query("posts_per_page=3&cat=25&post__not_in[]=".get_the_ID());
    if ($loopObject->have_posts()): foreach($loopObject->posts as $post):
      $title = ((strlen($post->post_title) > 50) && function_exists('loop_shortcode_title')) ? loop_shortcode_title($post->post_title) : $post->post_title ?>
      <div class="previous-block">
        <a href="<?=get_permalink($post->ID)?>" class="title" title="<?=strip_tags($post->post_title)?>"><?=$title?></a>
        by <a href="<?=get_author_posts_url('display_name', $post->post_author)?>" class="author"><?=get_the_author_meta('display_name', $post->post_author)?></a>
        on <span class="date"><?=date("F j\<\s\u\p\>S\<\/\s\u\p\>", mysql2date('U', $post->post_date))?></span>
      </div>
    <?php endforeach; endif; wp_reset_postdata(); ?>
  </div>
</div>
<?php endif; ?>

<article <?php post_class(); ?>>
  <div class="article-header<?php if($thumbnail > 599) { echo ' banner'; } ?>">
    <?php if($thumbnail > 599) { ?>
      <div class="banner-wrapper">
        <?php
          $topmargin = get_post_meta(get_the_ID(),'up-down', true);
          $leftmargin = get_post_meta(get_the_ID(),'left-right', true);
          $attr = array(
            'style' => "margin-top:{$topmargin};margin-left:{$leftmargin};"
          );
          the_post_thumbnail('full', $attr);
        ?>
      </div>
    <?php } ?>
    <div class="categories"><?php the_category(' '); ?></div>
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
    <div class="author">
      by <span class="name"><?php the_author_posts_link(); ?></span><?php
        if($otherauthors) {
          foreach($otherauthors as $key => $author_id) { ?>, <span class="name"><a rel="author" href="<?=get_author_posts_url($author_id)?>" title="Posts by <?=get_the_author_meta('display_name',$author_id)?>"><?=get_the_author_meta('display_name',$author_id)?></a></span><?php }
        }
      ?>
      on <span class="date">
          <a href="<?=$archive_month?>" title="Archive for the month of <?=date("F jS, Y", $post_time)?>"><?=date("F j\<\s\u\p\>S\<\/\s\u\p\>", $post_time)?></a>,
          <a href="<?=$archive_year?>" title="Archive for the year <?=date("Y", $post_time)?>"><?=date("Y", $post_time)?></a>
        </span>
    </div>
  </div>

  <div class="entry-content">
    <?php /* Our custom verbiage for our Working-Class Perspectives cross-posts */
    if(has_tag("working-class-perspectives")): ?>
      <aside class="alignright repost">
        <em>This post was originally featured in
        </em><strong><a href="https://workingclassstudies.wordpress.com/">Working-Class
        Perspectives: Commentary on Working-Class Culture, Education, and
        Politics</a></strong><em>, affiliated with the
        <a href="http://lwp.georgetown.edu/">Kalmanovitz Initiative for Labor
        and the Working Poor at Georgetown University</a>.</em>
      </aside>
    <?php endif; ?>

    <?php
      if(!get_post_meta(get_the_ID(), 'hide_author_boxes', true) && get_the_author_meta('ID') != 435) {
        set_query_var('author_id', get_the_author_meta('ID'));
        get_template_part('post', 'authorbox');
        if($otherauthors) {
          foreach($otherauthors as $key => $author_id) {
            set_query_var('author_id', $author_id);
            get_template_part('post', 'authorbox');
          }
        }
      }

      the_content();

      wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
      ) );
    ?>
  </div><!-- .entry-content -->

  <?php // Load the social media necessities
    $url = get_site_url() . $_SERVER["REQUEST_URI"];
    $url = urlencode($url);
  ?>
  <div class="social">
    <a href="http://www.facebook.com/sharer.php?u=<?=$url?>" class="icon-facebook"><span>Share on Facebook</span></a>
    <a href="http://twitter.com/share?url=<?=$url?>" class="icon-twitter"><span>Share on Twitter</span></a>
    <a href="https://plus.google.com/share?url=<?=$url?>" class="icon-google-plus"><span>Share on Google+</span></a>
    <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$url?>" class="icon-linkedin"><span>Share on LinkedIn</span></a>
    <a href="http://www.reddit.com/submit?url=<?=$url?>" class="icon-reddit"><span>Share on Reddit</span></a>
    <a href="http://pinterest.com/pin/create/button/?url=<?=$url?>" class="icon-pinterest"><span>Pin This</span></a>
    <a href="mailto:?subject=Check+out+this+article+at+LAWCHA.com&body=Hey!+Check+out+this+great+article+at+the+Labor+and+Working-Class+History+Association:+<?=$url?>" class="icon-mail"><span>Share over Email</span></a>
    <a href="http://www.printfriendly.com/print?url=<?=$url?>" class="icon-printer"><span>Print this Article</span></a>
  </div>

  <?php the_tags('<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>'); ?>
</article><!-- #post-## -->
