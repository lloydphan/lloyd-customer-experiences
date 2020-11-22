<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php wp_head(); ?>
    <?php
    global $wp;
    $url =  home_url($wp->request);
    $args = array(
        'orderby' => 'name',
        'order'   => 'ASC'
    );
    $categories = get_categories($args);
    ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark fixed-top">
            <div class="container">
                <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full'); ?>
                <h4><?php echo $logo ?></h4>
                <a class="navbar-brand" href="#"><?php the_custom_logo(); ?></a>
                <a class="navbar-description text-white" href="#">Tui dang test lung tung</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/customer-experience">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="/customer-experience" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chili
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                        <?php
                        $html = '';
                        foreach ($categories as $category) {
                            $activeStr = '';
                            $dropdownStr = ''; 
                            $dropdownToogle = '';
                            $liAttr = '';
                            if (strcasecmp(get_category_link($category->term_id), $url) == 0) {
                                $activeStr = 'active';
                            }
                            $childrenCategory = get_categories(array(
                                'parent' => $category->term_id
                            ));
                            if(count($childrenCategory) > 0) {
                                $dropdownStr = 'dropdown';
                                $dropdownToogle = 'dropdown-toggle';
                            }
                            foreach ($childrenCategory as $child) {
                            }
                            //$line  = '<li class="' . $activeStr . ' nav-item" ><a class="nav-link" href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/customer-experience/contact-us">Liên hệ
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>