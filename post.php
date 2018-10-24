<?php 
/**
 * Template Name: Post Archive
 */
get_header(); 


/**
 * Variáveis pros preguiçosos
 */
$tamanho_thumbnail = 'medium'; // para resolução personalizada utilizar: array( 350, 350 )
$texto_ler_mais    = 'Leia mais'
$maximo_de_posts   = 10;
$ordem             = 'DESC';
$ordenar_por       = 'date';
?>

<div class="header-pagina" style="background-image:url('<?= get_the_post_thumbnail_url() ?>');">
    <h1 class="page-title titulo-principal-pagina"><?php the_title(); ?></h1>
</div>

<?php 
$query = new WP_Query( array( 
    'post_type' => 'post',
    'posts_per_page' => $maximo_de_posts,
    'order' => $ordem,
    'orderby' => $ordenar_por
) ); 
?>

<div class="dft-grid container-loop-post">
    <?php if ( $query->have_posts() ):
        while( $query->have_posts() ): $query->the_post(); 
            /**
             * Início do loop dos posts padrões
             */
            ?>
            <div class="item-post">
                <div class="thumb-post"><?php the_post_thumbnail( 'medium' ); ?></div>
                <h2 class="titulo-post"><?php the_title(); ?></h2>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="ler-mais">Leia mais</a>
            </div>
        <?php endwhile;
    else:
        echo "Sem posts cadastrados.";
    endif; ?>
</div>
