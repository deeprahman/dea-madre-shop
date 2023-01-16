<?php

class DM_Hook_Methods
{
    public static function dm_single_product_image(){
        get_template_part('includes/template-parts/single-product/single-product-image');
    }

    public static function dm_single_product_summery(){
        get_template_part('includes/template-parts/single-product/single-product-summery');
    }

    public static function dm_single_add_to_cart(){
        global $product;
        do_action('woocommerce_' . $product->get_type() . '_add_to_cart');
    }

    public static function dm_single_product_quantity_label(){
        echo sprintf('<span class="%s">%s</span>&nbsp;', esc_html__('lead quantity-label', 'deamadre'), esc_html__('Quantity','deamadre'));
    }
}