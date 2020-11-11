<?php

if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

function theme_add_boostrap() {
    wp_register_style('bootstrap-style', get_template_directory_uri() . '/css/libs/bootstrap.min.css');
    wp_enqueue_style('bootstrap-style');
    
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