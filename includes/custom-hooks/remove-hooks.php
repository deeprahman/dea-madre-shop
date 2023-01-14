<?php

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);



/**
 * Products
 *

 */

remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);


$removed_hook_list = [
    'woocommerce_after_single_product_summary' => [
        10 => 'woocommerce_output_product_data_tabs',
        15 => 'woocommerce_upsell_display',
        20 => 'woocommerce_output_related_products'
    ],

    'woocommerce_single_product_summary' => [
        10 => 'woocommerce_template_single_rating',
        20 => 'woocommerce_template_single_excerpt',
        40 => 'woocommerce_template_single_meta',
        50 => 'woocommerce_template_single_sharing'
    ]

];


function removeActions(array $arg)
{
    foreach ($arg as $hook => $params) {
        foreach ($params as $priority => $callback) {
            remove_action($hook, $callback, $priority);
        }
    }
}

removeActions($removed_hook_list);
