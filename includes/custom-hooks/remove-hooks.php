<?php


$removed_hook_list = [
    'woocommerce_after_single_product_summary' => [
        [10 => 'woocommerce_output_product_data_tabs'],
        [15 => 'woocommerce_upsell_display'],
        [20 => 'woocommerce_output_related_products']
    ],

    'woocommerce_single_product_summary' => [
        [10 => 'woocommerce_template_single_rating'],
        [20 => 'woocommerce_template_single_excerpt'],
        [40 => 'woocommerce_template_single_meta'],
        [50 => 'woocommerce_template_single_sharing'],
        [30 => 'woocommerce_template_single_add_to_cart'],
        [5 => 'woocommerce_template_single_title'],
        [10 => 'woocommerce_template_single_price']
    ],
    'woocommerce_before_single_product_summary' => [
        [10 => 'woocommerce_show_product_sale_flash'],
        // [20 => 'woocommerce_show_product_images']
    ],
    'woocommerce_proceed_to_checkout' => [
        [10 => 'wc_get_pay_buttons'],
        [20 => 'woocommerce_button_proceed_to_checkout']
    ],
    'woocommerce_cart_collaterals' => [
        // [10 => 'woocommerce_cart_totals']
    ]


];


function removeActions(array $arg)
{
    foreach ($arg as $hook => $params) {
        foreach ($params as $info_arr) {
            $priority = array_key_first($info_arr);
            if (!remove_action($hook, $info_arr[$priority], $priority)) {
                return new WP_Error("The action" . $info_arr[$priority] . "could not be removed");
            }
        }
    }
}

removeActions($removed_hook_list);
