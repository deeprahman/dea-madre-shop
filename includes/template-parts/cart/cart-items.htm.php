<h2 class="display-5"><?php esc_html_e('Cart', 'deamadre'); ?></h2>

<div class="lead">

    <?php woocommerce_breadcrumb(); ?>
</div>

<section class="cart-items-container">
    <article data-cart-item-id="item-hash-1" class="d-flex flex-row gap-3">
        <!-- The cart item image -->
        <div class="cart-item-image py-2">
            <img width="150" height="150" src="https://wp.localhost/wp-content/uploads/2023/01/3059089658-150x150.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" decoding="async" loading="lazy" srcset="https://wp.localhost/wp-content/uploads/2023/01/3059089658-150x150.jpg 150w, https://wp.localhost/wp-content/uploads/2023/01/3059089658-100x100.jpg 100w" sizes="(max-width: 150px) 100vw, 150px" />
        </div>
        <!-- Cart item details -->
        <div class="cart-item-details d-flex flex-column justify-content-around w-100">
            <div class="cart-item-detail-top d-flex flex-row justify-content-between">
                <div class="cart-item-name me-5 fw-bold">
                    <span>Superb Wine</span>
                </div>
                <div class="cart-item-removal-link" data-bs-toggle="tooltip" data-bs-html="true" title="<?php esc_html_e('Remove this item', 'deamadre');?>">
                    <a class="" href="https://wp.localhost/cart/?remove_item=1f0e3dad99908345f7439f8ffabdffc4&amp;_wpnonce=74a7c15e14"><i class=" bi bi-x"></i></a>
                </div>
            </div>
            <div class="cart-item-detail-bottom d-flex flex-row justify-content-between">
                <div class="cart-item-quantity fw-bold">
                    <span class=""><?php esc_html_e('Qt.', 'deamadre'); ?></span>&nbsp <span>4</span>
                </div>
                <div class="cart-item-price fw-bold">
                    <span class="woocommerce-Price-amount amount"><bdi>49.80&nbsp;<span class="woocommerce-Price-currencySymbol">&euro;</span></bdi></span>
                </div>
            </div>
        </div>
    </article>
</section>


<div>
    <hr>
</div>
<section class="cart-totals d-flex flex-column my-3 ps-3">

    <div class="cart-net-subtotal d-flex flex-row justify-content-between my-1 lead">
        <span class=""><?php esc_html_e('Subtotal', 'deamadre'); ?></span>
     <bdi>62.25&nbsp;&euro;</bdi>
    </div>
    <div class="cart-discount d-flex flex-row justify-content-between lead">
        <span><?php esc_html_e('Shipping & Delivery', 'deamadre'); ?></span>
        <bdi>1.23&nbsp;&euro;</bdi>
    </div>
    <div class="cart-tax d-flex flex-row justify-content-between lead">
        <span><?php esc_html_e('VAT 22%', 'deamadre');?></span>
        <bdi>2.34&nbsp;&euro;</bdi>
    </div>
    <div class="cart-gross-total d-flex flex-row justify-content-between fw-bold mt-3 lead">
        <span><?php esc_html_e('Total', 'deamadre'); ?></span>

        <bdi>2.34&nbsp;&euro;</bdi>
    </div>
    <div>
        <small> <?php esc_html_e('22% VAT included', 'deamadre')?></small>
    </div>


</section>
<div>
    <hr>
</div>
<section class="apply-coupon mt-3">

    <form class="row g-3 justify-content-between">
        <div class="col-auto">
            <label for="coupon-code-input" class="visually-hidden">Email</label>
            <input type="text" class="form-control" id="coupon-code-input" name="cart_coupon"  placeholder="Enter Coupon Code">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary mb-3">Apply</button>
        </div>
    </form>

</section>

<section class="cart-item-help">
    <p class="lead">
        <a href="#" class="text-decoration-none"><?php esc_html_e('Is an item missing?', 'deamadre')?></a>
        <a href="#" class="text-decoration-none"><?php  esc_html_e('Continue Shopping')?></a>
    </p>
</section>