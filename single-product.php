<?php get_header(); ?>

<main id="single-product">
    
    <?php while (have_posts()) : ?>
    <?php the_post(); ?>

    <?php wc_get_template_part('content', 'single-product'); ?>

<?php endwhile; // end of the loop. 
?>

    

</main>

<?php get_footer(); ?>