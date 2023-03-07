<section id="cart-confirm-shipment-rate-part" class="cart-confirmation-group woocommerce">
    <h2>Shipment Rate Selection</h2>

        <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

            <?php do_action('woocommerce_cart_totals_before_shipping'); ?>

            <?php wc_cart_totals_shipping_html(); ?>

            <?php do_action('woocommerce_cart_totals_after_shipping'); ?>

        <?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>

            <tr class="shipping">
                <th><?php esc_html_e('Shipping', 'woocommerce'); ?></th>
                <td data-title="<?php esc_attr_e('Shipping', 'woocommerce'); ?>"><?php woocommerce_shipping_calculator(); ?></td>
            </tr>

        <?php endif; ?>


    <div class="row my-5">
        <div class="col">
            <button id="cart-page__shipment-form-submit-btn" class="btn btn-outline-secondary contact-btn rounded-pill fw-bold go-to-prev"><?php esc_html_e('Previous', 'deamadre') ?></button>
        </div>
        <div class="col">
            <button id="cart-page__shipment-form-submit-btn" class="btn btn-outline-secondary contact-btn rounded-pill fw-bold go-to-next"><?php esc_html_e('Next', 'deamadre') ?></button>
        </div>
    </div>
</section>