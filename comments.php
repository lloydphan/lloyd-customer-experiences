<?php
    function cus_exp_show_comments( $comment, $args, $depth) {
        global $count;
        $count++;
        if($comment->comment_approved == "1"):
?>            
    <div class="comment-padding card p-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="user d-flex flex-row align-items-center"> 
                <?php echo get_avatar($comment, 30, '', '', array('class'=> 'user-img rounded-circle mr-2')); ?>
                <span>
                    <small class="font-weight-bold text-primary"><?php comment_author($comment);?></small> 
                <small class="font-weight-bold"><?php echo nl2br(get_comment_text($comment)); ?></small>
                </span> 
            </div> 
            <small><?php comment_date('d M Y', $comment); ?></small>
        </div>
        <div class="action d-flex justify-content-between mt-2 align-items-center">
            <div class="reply px-4">
                <small>
                    <?php 
                        comment_reply_link(
                            array_merge(
                                $args,
                                array('depth' => $depth, 'max_depth' => $args['max_depth'])
                            )
                        )
                    ?>
                </small>
                <span class="dots"></span>
            </div>
        </div>
    </div>
<?php
    endif;
}
?>

<div class="col-md-12">
    <?php if ( have_comments() ) { ?>
        <div class="headings d-flex justify-content-between align-items-center mb-3">
            <h5><?php comments_number(__('No Comments', 'your-text-domain'), __('1 Comment', 'your-text-domain'), '% ' . __('Comments', 'your-text-domain') ); ?></h5>
        </div>
        <?php
            wp_list_comments( array('callback' => 'cus_exp_show_comments'));
        ?>
    <?php } ?>
    <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
        <h5>Phần comment không được mở</h5>
    <?php 
    }
    ?>
    <?php comment_form(); ?>
</div>
