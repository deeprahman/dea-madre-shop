<h2 class="display-5"><?php esc_html_e('Payment', 'deamadre'); ?></h2>

<?php get_template_part('includes/template-parts/cart/cart-confirm-account-part.htm'); ?>

<form class="row g-3" id="cart-confirm-checkout" action="POST"></form>
<?php get_template_part('includes/template-parts/cart/cart-confirm-shipment.htm'); ?>

<?php get_template_part('includes/template-parts/cart/cart-confirm-select-shipment-rate.htm'); ?>

<?php get_template_part('includes/template-parts/cart/cart-confirm-billing.htm'); ?>

<section class="info-for-next-steps">
    <div class="row mb-3">
        <div class="col">
            <h3 class="text-muted">
                <?php esc_html_e('Next steps', 'deamadre'); ?>
            </h3>
        </div>
    </div>

    <ol class="list-group list-group-numbered text-muted ">

        <li class=" d-flex justify-content-between align-items-start mb-3" for="cart-confirm-shipment-address-part">
            <div class="ms-2 me-auto">
                <div class="fw-bold"><?php esc_html_e('Shipping options', 'deamadre'); ?></div>
                <?php esc_html_e('Select how to receive your order.', 'deamadre') ?>
            </div>
        </li>


        <li class=" d-flex justify-content-between align-items-start mb-3" for="cart-confirm-billing-address-part">
            <div class="ms-2 me-auto">
                <div class="fw-bold"><?php esc_html_e('Payment Information', 'deamadre'); ?></div>
                <?php esc_html_e('Choose a payment method and enter your payment details.', 'deamadre') ?>
            </div>

        </li>
        <li class=" d-flex justify-content-between align-items-start mb-3">
            <div class="ms-2 me-auto">
                <div class="fw-bold"><?php esc_html_e('Confirm order', 'deamadre'); ?></div>
                <?php esc_html_e('Place your order and receive a confirmation email.', 'deamadre') ?>
            </div>

        </li>
    </ol>
</section>