<?php
if(!function_exists('cus_exp_setup')) {
    function cus_exp_setup() {
        $lang_folder = get_theme_file_path('languages');
        load_theme_textdomain('cus_exp', $lang_folder);
        // title tag
        add_theme_support('title-tag');
        add_theme_support('
            html5',
            array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
        // register nav_menu
        register_nav_menu('cus_exp_primary_menu', __('Primary Menu', 'cus_exp'));

        // Add theme support
        add_theme_support('post-thumbnails');

        // Link RSSs
        add_theme_support('automatic-feed-limk');

        // Images Size
        add_image_size('cus-exp-logo-size', 48, '', true);
        add_image_size('grid_post_thumbnail', 317, 216, true);
        add_image_size('list_post_thumbnail', 728, '', true);
        add_image_size('single_post_thumbnail', 800, 430, true);
        add_image_size('list_mini_thumbnail', 80, 80, true);
        add_image_size('author_thumbnail', 82, 82, true);
        
    };

}

if(is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
}
?>