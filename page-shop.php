<?php
/*
Template Name: Shop
*/

?>



<!-- The Header Section -->
<?php get_header() ?>
<!-- The Banner section -->
<?php get_template_part('includes/template-parts/shop/shop_banner.htm'); ?>

<!-- Products -->

<?php get_template_part('includes/template-parts/shop/_product_cat.htm'); ?>

<!-- Product WIne -->

<?php get_template_part('includes/template-parts/shop/_product_wine.htm'); ?>

<!-- Product Beverage -->

<?php get_template_part('includes/template-parts/shop/_product_beverage.htm'); ?>

<!-- Subscribers Section -->


<?php get_template_part('includes/template-parts/shop/_subscribe_section.htm'); ?>

<!-- Company Description -->

<?php get_template_part('includes/template-parts/shop/_company_description.htm'); ?>

<!-- Contact section -->

<?php get_template_part('includes/template-parts/shop/_contact_section.htm'); ?>

<!-- The Footer section -->
<?php get_footer(); ?>