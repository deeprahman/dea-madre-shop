<span class="product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
    <?php
    echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
    ?>
</span>