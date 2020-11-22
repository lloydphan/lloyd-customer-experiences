<?php
    $category = get_the_category(get_the_ID());
    $cat_id = $category[0]->cat_ID;
?>
<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        Trong chuyên mục : <?php echo get_cat_name($cat_id) !== '' ? get_cat_name($cat_id) : '' ; ?>
    </div>
    <?php
    $thumbnail_url = get_the_post_thumbnail(get_the_ID(), 'list_post_thumbnail', array(
        'class' => 'card-img-top'
    ));
    if ($thumbnail_url === '') {
        $thumbnail_url = '<img class="card-img-top size-list_post_thumbnail" src="http://placehold.it/750x300" alt="' . get_the_title() . '">';
    }
    echo $thumbnail_url;
    ?>
    <div class="card-body">
        <a href="<?php the_permalink(); ?>">
            <h2 class='card-title cus-exp-card-title'><?php the_title(); ?></h2>
        </a>
        <p class='card-text'><?php the_content(); ?></p>
    </div>
    <div class="card-footer bg-dark text-white">
        Đăng lúc <?php post_relative_time(); ?> by <?php the_author() ?>
    </div>
</div>