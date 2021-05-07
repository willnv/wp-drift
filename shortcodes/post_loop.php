<?php
/**
 * Simple post loop example
 * 
 * Options: 
 * post_type - String
 * posts_per_page - int
 */
function post_loop( $atts ) {

    $a = shortcode_atts( array(
        'post_type'      => 'post',
        'posts_per_page' => 4,
    ), $atts );

    $query = new WP_Query( array(
        'post_type'      => $a['post_type'],
        'posts_per_page' => $a['posts_per_page']
    ) );

    if ( $query->have_posts() ):
        while ( $query->have_posts() ): $query->the_post(); ?>

            <h2><?php the_title(); ?></h2>

        <?php endwhile;
    endif;
}
add_shortcode( 'post-loop', 'post_loop' );
