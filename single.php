<?php 

    /**
     *  Template usado para o single post
     */
    get_header();
?>

<div style="background-image:url('<?= get_the_post_thumbnail_url(); ?>');" class="page-title-single">
    <div class="main-grid">
       <div class="titulo-single">
           <?php the_title(); ?>
       </div>

       <div class="single-date">
           <?php the_date(); ?>
       </div>
   </div>
</div>

<section class="content-single-post main-content">
    <div class="main-grid">
        <?php while ( have_posts() ) : the_post();
            the_content();
        endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>
