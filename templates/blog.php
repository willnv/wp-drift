<?php 
/**
 * Template Name: Blog
 */
get_header(); 

$max_posts = 10;
$order     = 'DESC';
$orderby   = 'date';

$query = new WP_Query( array( 
    'post_type' => 'post',
    'posts_per_page' => $max_posts,
    'order' => $order,
    'orderby' => $orderby
) ); 
?>

<section class="container-loop-post main-content">
    <div class="main-grid">
        <?php if ( $query->have_posts() ):
            while( $query->have_posts() ): $query->the_post(); ?>
                <div class="item-post">
                    <div class="thumb-post"><?php the_post_thumbnail( 'medium' ); ?></div>
                    <div class="data-post"><?php the_date(); ?></div>
                    <h2 class="title-post"><?php the_title(); ?></h2>
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="read-more">Leia mais</a>
                </div>
            <?php endwhile;
        else:
            echo "<p>Posts not found.</p>";
        endif; ?>
    </div>
</section>

<?php get_footer();
