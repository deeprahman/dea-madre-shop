<?php
/*
Template Name: Shop
*/
?>


<!-- The Header Section -->

<?php get_header() ?>
<?php echo "<h1>Shop</h1>";?>
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