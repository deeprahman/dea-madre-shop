<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

?>
<div class="container">


	<?php

	/**
	 * Hook: woocommerce_before_single_product.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 */
	do_action('woocommerce_before_single_product');

	if (post_password_required()) {
		echo get_the_password_form(); // WPCS: XSS ok.
		return;
	}
	?>
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
		<div class="row my-5">

			<div class="single-product-image col-12 col-lg-6 ">

				<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked dm_single_product_image - 10
				 */
				do_action('woocommerce_before_single_product_summary');
				?>
			</div>

			<div class="summary entry-summary ps-3 ps-lg-5 col-12 col-lg-6 d-flex justify-content-center justify-content-lg-start">
				<div>

				<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked dm_single_product_summary - 10
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action('woocommerce_single_product_summary');
				?>
				</div>
			</div>
		</div>

		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action('woocommerce_after_single_product_summary');
		?>
	</div>

	<?php do_action('woocommerce_after_single_product'); ?>
</div>