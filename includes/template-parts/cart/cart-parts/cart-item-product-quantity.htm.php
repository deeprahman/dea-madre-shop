<span class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
    <?php
    if ($_product->is_sold_individually()) {
        $min_quantity = 1;
        $max_quantity = 1;
    } else {
        $min_quantity = 0;
        $max_quantity = $_product->get_max_purchase_quantity();
    }

    $product_quantity = woocommerce_quantity_input(
        array(
            'input_name'   => "cart[{$cart_item_key}][qty]",
            'input_value'  => $cart_item['quantity'],
            'max_value'    => $max_quantity,
            'min_value'    => $min_quantity,
            'product_name' => $_product->get_name(),
        ),
        $_product,
        false
    );

    echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
    ?>
</span>