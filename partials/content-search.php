<?php
    $category = get_the_category(get_the_ID());
    $cat_id = $category[0]->cat_ID;
?>
<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        Chuyên mục : <?php echo get_cat_name($cat_id); ?>
    </div>
    <div class="card-body">
        <a href="<?php the_permalink(); ?>">
            <h2 class='card-title cus-exp-card-title'><?php the_title(); ?></h2>
        </a>
        <p class='card-text'><?php the_excerpt(); ?></p>
    </div>
</div>