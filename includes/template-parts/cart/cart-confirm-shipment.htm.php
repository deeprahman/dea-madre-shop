<section id="cart-confirm-shipment-address-part" class="my-5">
    <h2 class="lead"><?php esc_html_e('Shipment Address Form', 'deamadre'); ?></h2>
<form id="cart-confirm-shipment-address-from" action="post">
    <!-- First Name -->
    <div class="row g-3 align-items-center my-3">
        <div class="col-auto">
            <label for="first-name" class="col-form-label"><?php esc_html_e('First Name', 'deamadre'); ?></label>
        </div>
        <div class="col-auto">
            <input name="shipping_first_name" type="password" id="first-name" class="form-control" aria-describedby="firstNameHelpInline" required>
        </div>
        <div class="col-auto">
            <span id="firstNameHelpInline" class="form-text">
                <?php esc_html_e('Input first name', 'deamadre'); ?>
            </span>
        </div>
    </div>

    <!-- Last Name -->
    <div class="row g-3 align-items-center my-3">
        <div class="col-auto">
            <label for="last-name" class="col-form-label"><?php esc_html_e('Last Name', 'deamadre'); ?></label>
        </div>
        <div class="col-auto">
            <input name="shipping_last_name" type="text" id="last-name" class="form-control" aria-describedby="lastHelpInline" required>
        </div>
        <div class="col-auto">
            <span id="lastHelpInline" class="form-text">
                <?php esc_html_e('Input Last name', 'deamadre'); ?>
            </span>
        </div>
    </div>

    <!-- Company name -->
    <div class="row g-3 align-items-center my-3">
        <div class="col-auto">
            <label for="company-name" class="col-form-label"><?php esc_html_e('Company Name', 'deamadre'); ?></label>
        </div>
        <div class="col-auto">
            <input name="shipping_company" type="text" id="company-name" class="form-control" aria-describedby="lastHelpInline">
        </div>
        <div class="col-auto">
            <span id="lastHelpInline" class="form-text">
                <?php esc_html_e('Input Company name', 'deamadre'); ?>
            </span>
        </div>
    </div>

    <!-- Country name -->
    <div class="row g-3 align-items-center my-3">
        <div class="col-auto">
            <label for="country-name" class="col-form-label"><?php esc_html_e('Company Name', 'deamadre'); ?></label>
        </div>
        <div class="col-auto">
            <select name="shipping_country" id="country-name" class="form-select">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="col-auto">
            <span id="lastHelpInline" class="form-text">
                <?php esc_html_e('Input Company name', 'deamadre'); ?>
            </span>
        </div>
    </div>

    <!-- Address line - 1 -->
    <div class="row g-3 align-items-center my-3">
        <div class="col-auto">
            <label for="address-line-1" class="col-form-label"><?php esc_html_e('Address line-1', 'deamadre'); ?></label>
        </div>
        <div class="col-auto">
            <input name="shipping_address_1" type="text" id="address-line-1" class="form-control" aria-describedby="address1HelpInline">
        </div>
        <div class="col-auto">
            <span id="address1HelpInline" class="form-text">
                <?php esc_html_e('Input Address', 'deamadre'); ?>
            </span>
        </div>
    </div>


    <!-- Address line - 2 -->
    <div class="row g-3 align-items-center my-3">
        <div class="col-auto">
            <label for="address-line-2" class="col-form-label"><?php esc_html_e('Address line-2', 'deamadre'); ?></label>
        </div>
        <div class="col-auto">
            <input name="shipping_address_2" type="text" id="address-line-2" class="form-control" aria-describedby="address1HelpInline">
        </div>
        <div class="col-auto">
            <span id="address1HelpInline" class="form-text">
                <?php esc_html_e('Input Address', 'deamadre'); ?>
            </span>
        </div>
    </div>

    <!-- Postcode -->
    <div class="row g-3 align-items-center my-3">
        <div class="col-auto">
            <label for="postcode" class="col-form-label"><?php esc_html_e('Postcode', 'deamadre'); ?></label>
        </div>
        <div class="col-auto">
            <input name="shipping_postcode" type="text" id="postcode" class="form-control" aria-describedby="postcodeHelpInline">
        </div>
        <div class="col-auto">
            <span id="postcodeHelpInline" class="form-text">
                <?php esc_html_e('Input Postcode', 'deamadre'); ?>
            </span>
        </div>
    </div>

    <!-- CIty -->
    <div class="row g-3 align-items-center my-3">
        <div class="col-auto">
            <label for="city-name" class="col-form-label"><?php esc_html_e('City Name', 'deamadre'); ?></label>
        </div>
        <div class="col-auto">
            <input name="shipping_city" type="text" id="city-name" class="form-control" aria-describedby="postcodeHelpInline">
        </div>
        <div class="col-auto">
            <span id="postcodeHelpInline" class="form-text">
                <?php esc_html_e('Input City Name', 'deamadre'); ?>
            </span>
        </div>
    </div>

    <!-- State name -->
    <div class="row g-3 align-items-center my-3">
        <div class="col-auto">
            <label for="state-name" class="col-form-label"><?php esc_html_e('State/Province Name', 'deamadre'); ?></label>
        </div>
        <div class="col-auto shipping-state-name">
            <select name="shipping_state" id="state-name" class="form-select">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="col-auto">
            <span id="lastHelpInline" class="form-text">
                <?php esc_html_e('Select or input state', 'deamadre'); ?>
            </span>
        </div>
    </div>
</form>

<div class="row my-5">
    <div class="col">
        <button class="btn btn-secondary"><?php esc_html_e('Save Address', 'deamadre')?></button>
    </div>
</div>
</section>