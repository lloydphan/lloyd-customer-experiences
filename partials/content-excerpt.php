<div class="card mb-4">
    <a href="<?php the_permalink(); ?>">
        <?php
            $thumbnail_url = get_the_post_thumbnail(get_the_ID(), 'list_post_thumbnail', array(
                'class' => 'card-img-top'
            ));
            if($thumbnail_url === '') {
                $thumbnail_url = '<img class="card-img-top size-list_post_thumbnail" src="http://placehold.it/750x300" alt="'. get_the_title() .'">';
            }
            echo $thumbnail_url;
        ?>
    </a>
    <div class="card-body">
        <a href="<?php the_permalink(); ?>">
            <h2 class='card-title cus-exp-card-title'><?php the_title(); ?></h2>
        </a>
        <p class='card-text'><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink() ?>" class="btn bg-dark btn-primary">Đọc thêm → </a>
    </div>
    <div class="card-footer text-muted">
        Đăng lúc <?php post_relative_time(); ?> by <?php the_author() ?>
    </div>
</div>