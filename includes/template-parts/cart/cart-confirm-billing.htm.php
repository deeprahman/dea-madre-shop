<section id="cart-confirm-billing-address-part">
    <h2>Billing Address</h2>
    <fieldset id="cart-page__shipping-form" class="row g-3" form="cart-confirm-checkout" action="POST">
        <div class="col-md-6">
            <label for="cart-page__shipping-first-name" class="form-label"><?php esc_html_e('First Name', 'deamadre'); ?></label>
            <input type="text" name="shipping_first_name" class="form-control" id="cart-page__shipping-first-name">
        </div>
        <div class="col-md-6">
            <label for="cart-page__shipping-last-name" class="form-label"><?php esc_html_e('Last Name', 'deamadre'); ?></label>
            <input type="text" name="shipping_last_name" class="form-control" id="cart-page__shipping-last-name">
        </div>
        <div class="col-12">
            <label for="cart-page__company-name" class="form-label"><?php esc_html_e('Company', 'deamadre'); ?></label>
            <input type="text" name="shipping_company" class="form-control" id="cart-page__company-name" placeholder="<?php esc_html_e('Example Pvt. Ltd', 'deamadre') ?>">
        </div>
        <div class="col-12">
            <label for="cart-page__shipping_address_1" class="form-label"><?php esc_html_e('Address Line 1', 'deamadre'); ?></label>
            <input type="text" name="shipping_address_1" class="form-control" id="cart-page__shipping_address_1" placeholder="Apartment, studio, or floor">
        </div>
        <div class="col-12">
            <label for="cart-page__shipping_address_2" class="form-label"><?php esc_html_e('Address Line 2', 'deamadre'); ?></label>
            <input type="text" name="shipping_address_2" class="form-control" id="cart-page__shipping_address_2" placeholder="Apartment, studio, or floor">
        </div>
        <div class="col-md-6">
            <label for="cart-page__shipping_country" class="form-label"><?php esc_html_e('Country', 'deamadre'); ?></label>
            <select id="cart-page__shipping_country" name="shipping_country" class="form-select">
                <option selected><?php esc_html_e('Select  your country'); ?></option>
                <option>...</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="cart-page__shipping-state" class="form-label"><?php esc_html_e('State/Province', 'deamadre'); ?></label>
            <input type="text" list="cart-page__state-datalist" id="cart-page__shipping-state" name="shipping_state" class="form-control">

        </div>
        <div class="col-md-4">
            <label for="cart-page__shipping_city" class="form-label"><?php esc_html_e('City', 'deamadre'); ?></label>
            <input type="text" name="shipping_city" class="form-control" id="cart-page__shipping-city">
        </div>
        <div class="col-md-4">
            <label for="cart-page__shipping_postcode" class="form-label"><?php esc_html_e('Postcode', 'deamadre'); ?></label>
            <input type="text" name="shipping_postcode" class="form-control" id="cart-page__shipping-postcode">
        </div>

    </fieldset>
        <div class="row my-5">
        <div class="col">
            <button id="cart-page__shipment-form-submit-btn" class="btn btn-outline-secondary contact-btn rounded-pill fw-bold go-to-submit"><?php esc_html_e('Submit', 'deamadre') ?></button>
        </div>
    </div>
</section>