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


    /**
     * Use namespaced data attribute for Bootstrap's dropdown toggles.
     *
     * @param array    $atts HTML attributes applied to the item's `<a>` element.
     * @param WP_Post  $item The current menu item.
     * @param stdClass $args An object of wp_nav_menu() arguments.
     * @return array
     */
    public static function prefix_bs5_dropdown_data_attribute($atts, $item, $args)
    {
        if (is_a($args->walker, 'WP_Bootstrap_Navwalker')) {
            if (array_key_exists('data-toggle', $atts)) {
                unset($atts['data-toggle']);
                $atts['data-bs-toggle'] = 'dropdown';
            }
        }
        return $atts;
    }

    /**
     * Register Custom Navigation Walker
     */
    public static function register_navwalker()
    {
        require_once INC_DIR . '/class-wp-bootstrap-navwalker.php';
    }
}
