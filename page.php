<?php get_header(); ?>

<?php 
    $query = new WP_Query(array(
        'post_type' => 'page'
    ));

    if ( $query->have_posts() ):
        while ( $query->have_posts() ): $query->the_post();
            the_content();
        endwhile;
    endif;

?>

<?php get_footer(); ?>