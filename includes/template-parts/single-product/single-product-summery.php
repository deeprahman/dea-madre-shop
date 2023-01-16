<?php

global $product;
$tax_info =DM_Utilities::getVatRate($product);
?>

<div>
    <div class="d-none d-md-block mb-3"><?php woocommerce_breadcrumb() ?></div>
    <h1 class="product-title display-6 mb-3"><?php echo $product->get_name(); ?></h1>
    <div class="product-price fw-normal fs-5 mb-3"><?php echo $product->get_price_html(); ?></div>
    <div class="product-tax lead mb-3">
        <span><?php echo esc_html__('Price incl. '.$tax_info['label'], 'deamadre') ?></span> <span><?php printf($tax_info['rate']) ?></span><span>&#37;</span>&nbsp;&nbsp;<span>(<?php printf(DM_Utilities::getProductTax($product)); ?>)</span>
    </div>

</div>

