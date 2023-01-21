<h2 class="display-5"><?php esc_html_e('Cart', 'deamadre'); ?></h2>

<div class="lead">

    <?php woocommerce_breadcrumb(); ?>
</div>




<?php

get_template_part('includes/template-parts/cart/cart-interface.htm');
wc_get_template('cart/cart-totals.php');
?>

<div>
    <hr>
</div>


<section class="cart-item-help">
    <p class="lead">
        <a href="#" class="text-decoration-none"><?php esc_html_e('Is an item missing?', 'deamadre') ?></a>
        <a href="<?php echo get_permalink(get_page_by_title( 'Shop' ));?>" class="text-decoration-none"><?php esc_html_e('Continue Shopping') ?></a>
    </p>
</section>