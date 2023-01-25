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
        // var_dump($wp);
        // exit('Class loader for url is called');
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

    public static function prefix_modify_nav_menu_args($args)
    {
        require_once INC_DIR . DIRECTORY_SEPARATOR . 'class-wp-bootstrap-navwalker.php';
        return array_merge($args, array(
            'walker' => new WP_Bootstrap_Navwalker(),
        ));
    }

    public static function dm_nav_menus()
    {
        $params = require_once INC_DIR . DIRECTORY_SEPARATOR . 'dm-nav-menu-params.php';
        register_nav_menus($params);
        add_filter('wp_nav_menu_args', ['DM_Hook_Methods', 'prefix_modify_nav_menu_args']);
        add_filter('nav_menu_link_attributes', ['DM_Hook_Methods', 'prefix_bs5_dropdown_data_attribute'], 20, 3);
    }
}
