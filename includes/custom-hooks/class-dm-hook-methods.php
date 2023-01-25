<?php

class DM_Hook_Methods
{
    public static function dm_single_product_image()
    {
        get_template_part('includes/template-parts/single-product/single-product-image');
    }

    public static function dm_single_product_summery()
    {
        get_template_part('includes/template-parts/single-product/single-product-summery');
    }

    public static function dm_single_add_to_cart()
    {
        global $product;
        do_action('woocommerce_' . $product->get_type() . '_add_to_cart');
    }

    public static function dm_single_product_quantity_label()
    {
        echo sprintf('<span class="%s">%s</span>&nbsp;', esc_html__('lead quantity-label', 'deamadre'), esc_html__('Quantity', 'deamadre'));
    }

    public static function dm_class_loader_par_url(WP $wp)
    {
        var_dump($wp);
        exit('Class loader for url is called');
    }

    public static function jk_dequeue_styles($enqueue_styles)
    {
        unset($enqueue_styles['woocommerce-general']);      // Remove the gloss
        unset($enqueue_styles['woocommerce-layout']);            // Remove the layout
        unset($enqueue_styles['woocommerce-smallscreen']);      // Remove the smallscreen optimisation
        return $enqueue_styles;
    }
}
