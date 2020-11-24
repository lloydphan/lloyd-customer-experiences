<?php

get_header();
?>
<?php
$url =  home_url($wp->request);
$cat_args = array(
    'orderby' => 'name',
    'order'   => 'ASC'
);
$categories = get_categories($cat_args);
?>
<div class="container cus-exp-header">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="my-4"><?php echo get_bloginfo('name') ?>
                <br />
                <small><?php echo get_bloginfo('description') ?></small>
            </h1>

            <!-- Loop Post -->
            <?php
            $post_id = get_the_ID();
            $post_args = array(
                'p'                 => $post_id,
                'post_type'         => 'post',
                'posts_per_page'    => 10
            );
            $home_query = new WP_Query($post_args);
            if ($home_query->have_posts()) :
            ?>
            <?php
                while ($home_query->have_posts()) :
                    $home_query->the_post();
                    get_template_part('partials/content', get_post_format());
                endwhile;
            endif;
            ?>

            <!-- <div id="comments" class="">
                <div class="card mb-3 wow fadeIn">
                    <div class="card-header bg-dark text-white">Leave a reply</div>
                    <div class="card-body">

                        <div id="respond" class="comment-respond">
                            <h3 id="reply-title" class="comment-reply-title"> <small><a rel="nofollow" id="cancel-comment-reply-link" href="/trevelers-toolbox/#respond" style="display:none;">Cancel reply</a></small></h3>
                            <form action="https://wpt-blog.mdbootstrap.com/wp-comments-post.php" method="post" id="commentform" class="comment-form">

                                <div class="form-group">
                                    <label for="comment">Your comment</label>
                                    <textarea id="comment" name="comment" type="text" class="form-control" rows="5"></textarea>
                                </div>

                                <label for="name">Your name<span class="required">*</span> </label>
                                <input type="text" id="author" name="author" class="form-control" value="" aria-required="true">


                                <label for="email">Your email<span class="required">*</span></label>
                                <input type="text" id="email" name="email" class="form-control" aria-required="true" value="">

                                <p class="form-submit">
                                    <div class="waves-input-wrapper waves-effect waves-light"><input name="submit" type="submit" id="submit" class="btn btn-info btn-md " value="post "></div> <input type="hidden" name="comment_post_ID" value="15" id="comment_post_ID">
                                    <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card my-4">
                <h6 class="card-header text-white bg-dark">Tìm kiếm</h6>
                <div class="card-body">
                    <form role="search" method="get" id="searchform" class="searchform" action="<?php echo $url; ?>">
                        <div class="input-group">
                            <input id="s" type="text" name="s" class="form-control" placeholder="Tìm kiếm...">
                            <span class="input-group-append">
                                <input id="searchSubmit" class="btn btn-primary" type="submit" value="Tìm">
                            </span>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="card my-4">
                <h6 class="card-header text-white bg-dark">Thư mục</h6>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled mb-0">
                                <?php
                                foreach ($categories as $category) {
                                    echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . ' (' . $category->count . ' bài viết )</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Widget -->
            <?php if (is_active_sidebar('right-side-widge-content')) : ?>
                <?php dynamic_sidebar('right-side-widge-content'); ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php
get_footer();
?>