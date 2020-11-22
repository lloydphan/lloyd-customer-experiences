<?php

get_header(); 
?>
<?php 
    $args = array(
        'orderby' => 'name',
        'order'   => 'ASC'
    );
    $categories = get_categories($args);
?>
<div class="container cus-exp-header">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="my-4"><?php echo get_bloginfo('name') ?>
                <br/>
                <small><?php echo get_bloginfo('description') ?></small>
            </h1>

            <!-- Loop Post -->
            <?php 
                if(!is_single()):
                    get_template_part( 'template-parts/content', 'page' );
                else:
                    get_template_part( 'template-parts/content', 'single' );
                endif;
			?>

			<!-- Pagination -->
            <ul class="pagination justify-content-center mb-4">
                <li class="page-item">
                    <a class="page-link" href="#">← Older</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Newer →</a>
                </li>
            </ul>
		</div>
		
		<!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header text-white bg-dark">Tìm kiếm</h5>
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm...">
                        <span class="input-group-append">
                            <button class="btn btn-primary" type="button">Go!</button>
                        </span>
                    </div>
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
            <div class="card my-4">
                <h5 class="card-header">Side Widget</h5>
                <div class="card-body">
                    You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                </div>
            </div>

        </div>

	<?php
	// while ( have_posts() ) : the_post();

	// 	get_template_part( 'template-parts/content', 'page' );

	// 	// If comments are open or we have at least one comment, load up the comment template.
	// 	if ( comments_open() || get_comments_number() ) :
	// 		comments_template();
	// 	endif;

	// endwhile; 
	?>

<?php
get_footer();
?>