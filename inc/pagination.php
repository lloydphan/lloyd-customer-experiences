<?php
    if(!function_exists('cus_exp_pagination')) {
        function cus_exp_pagination(WP_Query $wp_query = null, $echo = true) {
             if($wp_query === null ) {
                 global $wp_query;
             }

             $pages = paginate_links( array(
                'base' => str_replace(9999999999, '%#%', esc_url(get_pagenum_link( 9999999999))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $wp_query->max_num_pages,
                'type' => 'array',
                'show_all' => false,
                'end_size' => 2,
                'mid_size' => 1,
                'prev_next' => true,
                'prev_text' => '<i class="zmdi zmdi-chevron-left>"', 
                'next_text' => '<i class="zmdi zmdi-chevron-right>"',
                'add_args' => false,
                'add_fragment' => ''
             ));
        }
    }