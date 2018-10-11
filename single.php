<?php 

    /**
     *  Template usado para o single post
     */
    get_header();

    $img_destacada = get_the_post_thumbnail_url();
?>

<div style="background-image:url('<?= $img_destacada; ?>');" class="page-title-single">
    <div class="dft-grid">

       <div class="titulo-single">
           <?php the_title(); ?>
       </div>

       <div class="single-date">
           <?php the_date(); ?>
       </div>
       
   </div>
</div>


<div class="content-single">
    <div class="dft-grid">
    <?php while ( have_posts() ) : the_post();
            the_content();
        endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>
