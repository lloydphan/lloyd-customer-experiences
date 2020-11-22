<?php

// setup - define
define('THEME_URI', get_theme_file_uri());
define('THEME_PATH', get_theme_file_path());

// INCLUDES
include(get_theme_file_path().'/inc/setup.php');
include(get_theme_file_path().'/inc/pagination.php');


if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
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



/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';
