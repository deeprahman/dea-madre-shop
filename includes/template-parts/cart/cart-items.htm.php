<h2 class="display-5"><?php esc_html_e('Cart', 'deamadre'); ?></h2>

<?php woocommerce_breadcrumb(); ?>

<div class="cart-items-container">
    <article></article>
</div>

<div class="cart-tot">

    <?php
    global $woocommerce;

    // Subtotal
    $subtotal = 0;
    foreach (WC()->cart->get_cart() as $cart_item) {
        $subtotal += $cart_item['line_subtotal'];
    }

    // Tax
    $tax = WC()->cart->get_taxes_total();

    // Discount
    $discount = WC()->cart->get_discount_total();

    // Shipping
    $shipping_cost = WC()->cart->get_shipping_total();

    // Total
    $total = $subtotal + $tax + $shipping_cost - $discount;

    echo '<p>Subtotal: ' . wc_price($subtotal) . '</p>';
    echo '<p>Tax: ' . wc_price($tax) . '</p>';
    echo '<p>Shipping: ' . wc_price($shipping_cost) . '</p>';
    echo '<p>Discount: ' . wc_price($discount) . '</p>';
    echo '<p>Total: ' . wc_price($total) . '</p>';

    ?>
</div>