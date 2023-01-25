<h2 class="display-5"><?php esc_html_e('Payment', 'deamadre'); ?></h2>
<section class="cart-item-confirm">
    <p class=" text-muted">
        <span>
            <?php esc_html_e('Updates on the status of your order will be sent to the email address specified in your account', 'deamadre'); ?>
        </span>
        <a href="<?php wc_get_page_permalink('myaccount') ?>">
            <?php esc_html_e('Change email', 'deamadre'); ?>
        </a>
    </p>
    <div class="cart-item-confirm__email my-3">

        <input class="form-control text-muted form-control-lg" value="<?php echo wp_get_current_user()->user_email ?>" type="email" placeholder="" aria-label=".form-control-lg example">
    </div>
    <div class="form-check my-3 text-muted">
        <input class="form-check-input" type="checkbox" value="" id="acceptSellsTerms">
        <label class="form-check-label" for="acceptSellsTerms">
            <?php esc_html_e('I accept', 'deamadre'); ?>&nbsp;
            <a class=" text-muted" href="<?php wc_get_page_permalink('refund_returns') ?>"><?php esc_html_e('the Terms and conditions of sale'); ?></a>
        </label>
    </div>
    <div class="form-check my-3 text-muted">
        <input class="form-check-input" type="checkbox" value="" id="receivePromotion" checked>
        <label class="form-check-label" for="receivePromotion">
            <?php esc_html_e('Receive special offers and dedicated promotions.', 'deamadre'); ?>
        </label>
    </div>
    <div class="row row-cols-1 row-cols-lg-2 my-3">
        <div class="col">

            <button id="checkout-btn" class="btn btn-outline-primary rounded-pill contact-btn fw-bold">
                <?php esc_html_e('Go to the checkout', 'deamadre') ?>
            </button>
        </div>
        <div class="col">
            <div class="d-flex flex-row gap-2">
                <div class="text-muted ">
                    <svg class="text-success" width="18" height="23" viewBox="0 0 18 23" xmlns="http://www.w3.org/2000/svg">
                        <g fill="currentColor" fill-rule="evenodd">
                            <path d="M15 9h1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V11a2 2 0 0 1 2-2h1V6a6 6 0 1 1 12 0v3zm-2 0V6a4 4 0 1 0-8 0v3h8zM2 10a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V11a1 1 0 0 0-1-1H2z" fill-rule="nonzero"></path>
                            <path d="M8 16.732a2 2 0 1 1 2 0V18a1 1 0 0 1-2 0v-1.268z"></path>
                        </g>
                    </svg>
                </div>
                <p class="">

                    <span class="text-muted text-success">
                        <?php esc_html_e('All data is transmitted encrypted over a secure TLS connection.', 'deamadre'); ?>
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>
<section class="info-for-next-steps">
    <div class="row mb-3">
        <div class="col">
            <h3 class="text-muted">

                <?php esc_html_e('Next steps', 'deamadre'); ?>
            </h3>
        </div>
    </div>

    <ol class="list-group list-group-numbered text-muted">
        <li class=" d-flex justify-content-between align-items-start mb-3">
            <div class="ms-2 me-auto">
                <div class="fw-bold"><?php esc_html_e('Shipping options', 'deamadre'); ?></div>
                <?php esc_html_e('Select how to receive your order.', 'deamadre') ?>
            </div>

        </li>

        <li class=" d-flex justify-content-between align-items-start mb-3">
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