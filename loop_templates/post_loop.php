<?php
/**
 * Variáveis, funçõs:
 * 
 * $img_destacada
 * $url_img_destacada
 * $
 * 
 * 
 * the_title();
 * the_excerpt();
 * the_content();
 * the_date(); #
 */
?>

<div class="container-post-loop loop<?= $a['post_type']; ?>">
    <?php if ( $query->have_posts() ): 
        while ( $query->have_posts() ): $query->the_post(); ?>
            <div class="item-post">

                <h3 class="post-loop-title"><?php the_title(); ?></h3>
                <div class="post-loop-desc"><?php the_excerpt(); ?></div>
            </div>
        <?php endwhile; 
    endif;?>
</div>