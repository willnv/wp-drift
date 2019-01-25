<?php 
/**
 * Template Name: Blog
 */
get_header(); 


/**
 * Variáveis
 */
$maximo_de_posts   = 10;
$ordem             = 'DESC';
$ordenar_por       = 'date';

$query = new WP_Query( array( 
    'post_type' => 'post',
    'posts_per_page' => $maximo_de_posts,
    'order' => $ordem,
    'orderby' => $ordenar_por
) ); 
?>

<section class="container-loop-post main-content">
    <div class="main-grid">
        <?php if ( $query->have_posts() ):
            while( $query->have_posts() ): $query->the_post();
                /**
                 * Início do loop dos posts padrões
                 */
                ?>
                <div class="item-post">
                    <div class="thumb-post"><?php the_post_thumbnail( 'medium' ); ?></div>
                    <div class="data-post"><?php the_date(); ?></div>
                    <h2 class="titulo-post"><?php the_title(); ?></h2>
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="ler-mais">Leia mais</a>
                </div>
            <?php endwhile;
        else:
            echo "<p>Sem posts cadastrados.</p>";
        endif; ?>
    </div>
</section>

<?php get_footer();
