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
            <?php  
                $searchQ = get_search_query(); 
                $default_posts_per_page = get_option( 'posts_per_page' );
                $searchQ = get_search_query();
                $mypostids = $wpdb->get_col("select ID from $wpdb->posts where post_title like '%$searchQ%' ");
                $post_args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => $default_posts_per_page,
                    'post__in'          => $mypostids
                ); 
                $home_query = new WP_Query( $post_args );
                if($home_query->have_posts()):
            ?>
            <h1 class="my-4">
                <small>Tìm kiếm ( <?php echo $home_query->post_count ?> bài viết ) : <?php echo $searchQ?></small>
            </h1>

            <!-- Loop Post -->
            <?php
                 while($home_query->have_posts()):
                    $home_query->the_post();
                    get_template_part( 'partials/content', 'search' );
                 endwhile;       
            ?>

            <ul class="pagination justify-content-center mb-4">
                <li class="page-item">
                    <?php
                        previous_posts_link( __('Bài mới','cus_exp'));
                    ?>
                </li>
                <li class="page-item">
                    <?php
                        next_posts_link( __('Bài cũ','cus_exp'));
                    endif;
                    ?>
                </li>
            </ul>
		</div>
		
		<!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header text-white bg-dark">Tìm kiếm</h5>
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
                <h5 class="card-header text-white bg-dark">Thư mục</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled mb-0">
                                <?php
                                    foreach($categories as $category) {
                                        echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name .' (' . $category->count .' bài viết )</a></li>';
                                     }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Widget -->
            <?php if ( is_active_sidebar( 'right-side-widge-content' ) ) : ?>
                <?php dynamic_sidebar( 'right-side-widge-content' ); ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php
get_footer();
?>