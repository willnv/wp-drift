<?php get_header(); ?>

<!-- Start main content-->
<section class="main-content">
    <div class="main-grid">
        <?php if ( have_posts() ):
            while ( have_posts() ): the_post();
                the_content();
            endwhile;
        endif; ?>
    </div>
</section>

<?php get_footer();
