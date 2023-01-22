	<span class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
	    <?php
        echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
        ?>
	</span>