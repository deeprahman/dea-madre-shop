<?php
/*
Template Name: Shop
*/
?>


<!-- The Header Section -->

<?php get_header() ?>
<!-- <h1>Good</h1> -->
<?php woocommerce_breadcrumb();?>
<main>
	<?php
	/**
	 * @hook dea-madre-shop-content
	 * @hooked	dea_madre_display_products
	 */
	do_action('dea-madre-shop-content');
	?>
</main>


<!-- The Footer section -->
<?php get_footer(); ?>