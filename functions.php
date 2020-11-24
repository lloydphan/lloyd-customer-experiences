<?php

// setup - define
define('THEME_URI', get_theme_file_uri());
define('THEME_PATH', get_theme_file_path());

// INCLUDES
include(get_theme_file_path().'/inc/setup.php');
include(get_theme_file_path().'/inc/pagination.php');

// Change get custom logo
add_filter('get_custom_logo', 'change_logo_class');

if(!function_exists('change_logo_class')) {
    function change_logo_class($html) {
        $html = str_replace('custom-logo-link', 'navbar-brand', $html);
        $html = str_replace( 'custom-logo', 'size-cus-exp-logo-size', $html );
        return $html;
    }
}

// Paginator UI
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

function posts_link_attributes() {
    return 'class="page-link"';
}

function customer_exp_post_thumbnails() {
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'customer_exp_post_thumbnails' );

add_action('init', 'cus_exp_setup');

function limit_words($phrase, $len) {
    $len = (int) $len;
    if (str_word_count($phrase) > $len) {
        $keys = array_keys(str_word_count($phrase, 2));
        $phrase = substr($phrase, 0, $keys[$len]);
        $phrase .= " ...";
    }
    return $phrase;
}


function post_relative_time() { 
    $post_date = get_the_time('U');
    $delta = time() - $post_date;
    if ( $delta < 60 ) {
        echo 'Bây giờ';
    }
    elseif ($delta > 60 && $delta < 120){
        echo '1 phút trước';
    }
    elseif ($delta > 120 && $delta < (60*60)){
        echo strval(round(($delta/60),0)), ' phút trước';
    }
    elseif ($delta > (60*60) && $delta < (120*60)){
        echo '1 giờ trước';
    }
    elseif ($delta > (120*60) && $delta < (24*60*60)){
        echo strval(round(($delta/3600),0)), ' giờ trước ago';
    }
    else {
        echo the_time('j\<\s\u\p\>S\<\/\s\u\p\> M y g:i a');
    }
}

function theme_add_boostrap()
{
    wp_register_style('bootstrap-style', get_template_directory_uri() . '/css/libs/bootstrap.min.css');
    wp_enqueue_style('bootstrap-style');

    wp_enqueue_style('customer-exp-style', get_stylesheet_uri());

    //jquery
    wp_register_script('jquery3-2-1', get_template_directory_uri() . '/js/libs/jquery-3.2.1.slim.min.js');
    wp_enqueue_script('jquery3-2-1');

    //jquery
    wp_register_script('popper-js', get_template_directory_uri() . '/js/libs/popper.min.js');
    wp_enqueue_script('popper-js');

    // bootstrap
    wp_register_script('bootstrap-script', get_template_directory_uri() . '/js/libs/bootstrap.min.js');
    wp_enqueue_script('bootstrap-script');
}
add_action('wp_enqueue_scripts', 'theme_add_boostrap');


add_theme_support('custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array('site-title', 'site-description'),
));

register_sidebar(array(
    'name' => 'Right side widget content',
    'id' => 'right-side-widge-content',
    'description' => 'Khu vực hiển thị side bar bên phải',
    'before_widget' => '<div id="%1$s" class="card my-4">',
    'after_widget'  => '</div>',
    // 'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    // 'after_widget' => '</aside>',
    'before_title' => '<h5 class="card-header">',
    'after_title' => '</h5>'
));


/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Comments
 */


// Custom Callback
            
function cus_exp_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	    
		<div class="comment-wrap">
			<div class="comment-img">
				<?php echo get_avatar($comment,$args['avatar_size'],null,null,array('class' => array('img-responsive', 'img-circle') )); ?>
			</div>
			<div class="comment-body">
				<h4 class="comment-author"><?php echo get_comment_author_link(); ?></h4>
				<span class="comment-date"><?php printf(__('%1$s at %2$s', 'your-text-domain'), get_comment_date(),  get_comment_time()) ?></span>
				<?php if ($comment->comment_approved == '0') { ?><em><i class="fa fa-spinner fa-spin" aria-hidden="true"></i> <?php _e('Comment awaiting approval', 'your-text-domain'); ?></em><br /><?php } ?>
				<?php comment_text(); ?>
				<span class="comment-reply"> <?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'your-text-domain'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?></span>
			</div>
		</div>
<?php }

// Enqueue comment-reply

add_action('wp_enqueue_scripts', 'your_theme_slug_public_scripts');

function your_theme_slug_public_scripts() {
    if (!is_admin()) {
        if (is_singular() && get_option('thread_comments')) { wp_enqueue_script('comment-reply'); }
    }
}

// Enqueue fontawesome

add_action('wp_enqueue_scripts', 'your_theme_slug_public_styles');

function your_theme_slug_public_styles() {
        wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all');
}

    
