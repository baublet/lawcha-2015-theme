<?php

if (!function_exists('lawcha_setup')):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lawcha_setup()
{
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support('post-thumbnails', array('post','event'));
    set_post_thumbnail_size(150, 150, true);
    
    add_image_size('large-thumb', 600, 300, true);
    add_filter('image_size_names_choose', 'lawcha_custom_sizes');
    function lawcha_custom_sizes($sizes)
    {
        return array_merge($sizes, array(
            'large-thumb' => 'Large Thumbnail',
        ));
    }

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(array(
        'main' => 'Primary Menu',
        'news'  => 'News Categories Menu',
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array('search-form', 'gallery', 'caption'));

    /*
     * Our custom post types to streamline SO MUCH of the event nonsense
     */
    register_post_type(
        'event',
        array(
          'labels' => array(
            'name' => __('Events'),
            'singular_name' => __('Event')
          ),
          'public' => true,
          'has_archive' => true,
          'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
        )
  );
}
add_action('after_setup_theme', 'lawcha_setup');
endif;

/**
 * Setup custom user profile meta fields
 */

/**
 * The field on the editing screens.
 *
 * @param $user WP_User user object
 */
function lawcha_usermeta_form_field_affiliation($user)
{
    ?>
    <table class="form-table">
        <tr>
            <th>
                <label for="birthday">Affiliation</label>
            </th>
            <td>
		<textarea rows="5" cols="30" id=affiliation" name="affiliation"><?= esc_attr(get_user_meta($user->ID, 'affiliation', true)); ?></textarea>
            </td>
        </tr>
    </table>
    <?php
}
 
/**
 * The save action.
 *
 * @param $user_id int the ID of the current user.
 *
 * @return bool Meta ID if the key didn't exist, true on successful update, false on failure.
 */
function lawcha_usermeta_form_field_affiliation_update($user_id)
{
    // check that the current user have the capability to edit the $user_id
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
 
    // create/update user meta for the $user_id
    return update_user_meta(
        $user_id,
        'affiliation',
        $_POST['affiliation']
    );
}
 
add_action(
    'edit_user_profile',
    'lawcha_usermeta_form_field_affiliation'
);
 
// add the field to user profile editing screen
add_action(
    'show_user_profile',
    'lawcha_usermeta_form_field_affiliation'
);
 
// add the save action to user's own profile editing screen update
add_action(
    'personal_options_update',
    'lawcha_usermeta_form_field_affiliation_update'
);
 
// add the save action to user profile editing screen update
add_action(
    'edit_user_profile_update',
    'lawcha_usermeta_form_field_affiliation_update'
);

if (!function_exists('lawcha_widgets_init')):
/**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function lawcha_widgets_init()
{
    register_sidebar(array(
        'name'          => 'Footer Widget',
        'id'            => 'footer-1',
        'description'   => 'Add widgets here to appear in your footer.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'lawcha_widgets_init');
endif;

if (!function_exists('lawcha_load_scripts')):
/*
 * For loading up custom styles only on pages, not in the admin area
 *
 */
function lawcha_load_scripts()
{
    wp_enqueue_style('less-compressed', get_template_directory_uri() . '/compressed.css', [], "20190205");
}
add_action('wp_enqueue_scripts', 'lawcha_load_scripts');
endif;

/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
if (! function_exists('post_is_in_descendant_category')) {
    function post_is_in_descendant_category($cats, $_post = null)
    {
        foreach ((array) $cats as $cat) {
            // get_term_children() accepts integer ID only
            $descendants = get_term_children((int) $cat, 'category');
            if ($descendants && in_category($descendants, $_post)) {
                return true;
            }
        }
        return false;
    }
}

/* I hate the default WordPress excerpt junkery. */
if (!function_exists('lawcha_new_excerpt_more')):
function lawcha_new_excerpt_more($more)
{
    return '';
}
add_filter('excerpt_more', 'lawcha_new_excerpt_more');
endif;

/* For various messages and confirmations. */
function lawcha_msg($atts, $content = null)
{
    extract(shortcode_atts(array(
        'var' => null,
        'val' => null
    ), $atts));
    if ($_GET[$var] == $val) {
        return $content;
    }
}
add_shortcode('msg', 'lawcha_msg');

/* Unqueues all the trashy plugin stylesheets and scripts */
function disable_junk()
{
    /* The Emojis... */
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    wp_dequeue_style('yarppWidgetCss');
    wp_dequeue_script('jquery');
}
add_action('init', 'disable_junk', 99);

/**
 * Wrapper for wp_head() which manages SSL
 *
 * @uses	wp_head()
 * @param	bool	$ssl
 * @return	void
 */
function lawcha_wp_head()
{
    // Capture wp_head output with buffering
    ob_start();
    wp_head();
    $wp_head = ob_get_contents();
    ob_end_clean();

    // Replace plain protocols with relative protocols
    $wp_head = str_replace("http://", "//", $wp_head);

    // Output
    echo $wp_head;
}

/**
 * Wrapper for wp_footer() which manages SSL
 *
 * @uses	wp_footer()
 * @param	bool	$ssl
 * @return	void
 */
function lawcha_wp_footer()
{
    // Capture wp_head output with buffering
    ob_start();
    wp_footer();
    $wp_footer = ob_get_contents();
    ob_end_clean();

    // Replace plain protocols with relative protocols
    $wp_footer = str_replace("http://", "//", $wp_footer);

    // Output
    echo $wp_footer;
}

/**
 * Removes wpautop if the post meta desires it
 */
function custom_wpautop($content)
{
    if (!get_field('wpautop') && is_page()) {
        return $content;
    }
    return wpautop($content);
}

remove_filter('the_content', 'wpautop');
add_filter('the_content', 'custom_wpautop');


/**
 * Removes images from old posts to protect against copyright trolls
 */
function remove_images_from_old_posts($content)
{
    if (get_post_type() !== 'post') {
        return $content;
    }

    $post = get_post();

    if (strtotime($post->post_date) > strtotime('-2 years')) {
        return $content;
    }

    $content = preg_replace("<figure id=.*<\/figure>", "", $content);
    $content = preg_replace("<p></p>\n", "", $content);
    return $content;
}

add_filter('the_content', 'remove_images_from_old_posts');
