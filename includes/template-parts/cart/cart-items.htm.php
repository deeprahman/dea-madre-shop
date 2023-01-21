<h2 class="display-5"><?php esc_html_e('Cart', 'deamadre'); ?></h2>

<div class="lead">

    <?php woocommerce_breadcrumb(); ?>
</div>




<?php

get_template_part('includes/template-parts/cart/cart-item-list.htm');
wc_get_template('cart/cart-totals.php');
?>

<div>
    <hr>
</div>
<section class="apply-coupon mt-3">

    <form class="row g-3 justify-content-between">
        <div class="col-auto">
            <label for="coupon-code-input" class="visually-hidden">Email</label>
            <input type="text" class="form-control" id="coupon-code-input" name="cart_coupon" placeholder="Enter Coupon Code">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary mb-3">Apply</button>
        </div>
    </form>

</section>

<section class="cart-item-help">
    <p class="lead">
        <a href="#" class="text-decoration-none"><?php esc_html_e('Is an item missing?', 'deamadre') ?></a>
        <a href="#" class="text-decoration-none"><?php esc_html_e('Continue Shopping') ?></a>
    </p>
</section>