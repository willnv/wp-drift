<?php 

/**
 *  Template usado para o single post
 */
get_header();

while ( have_posts() ) : the_post(); ?>

    <div style="background-image:url('<?= get_the_post_thumbnail_url(); ?>');" class="page-title-single">
        <div class="main-grid">
            <div class="titulo-single"><h1><?php the_title(); ?></h1></div>
            <div class="single-date"><time><?php the_date(); ?></time></div>
        </div>
    </div>
    <section class="content-single-post main-content">
        <div class="main-grid">
            <?php the_content(); ?>
            <div class="data-modificado"><p>Modificado em: <time><?php the_modified_date(); ?></time></p></div>
        </div>
    </section>
    
<?php endwhile;

get_footer();
