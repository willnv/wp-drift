<?php


function post_loop( $args ) {
    $a = shortcode_atts( array(
        'post_type'      => 'post',
        'posts_per_page' => 4,

    ), $atts );

    $query = new WP_Query( array(
        'post_type'      => $a['post_type'],
        'posts_per_page' => $a['posts_per_page']
    ) );

    require_once( '../loop_templates/post_loop.php' );
}
add_action( 'post-loop', 'post_loop' );