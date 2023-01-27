<?php

final class DM_Utilities
{
    /**
     * Returns the tax amount for a given WC_Product object
     *
     * @param WC_Product $product
     * @return float
     */
    public static function getProductTax(WC_Product $product): float
    {
        $include_tax = wc_get_price_including_tax($product);
        $exclude_tax = wc_get_price_excluding_tax($product);
        return (float) ($include_tax -  $exclude_tax);
    }

    /**
     * Get tax rates for a product
     *
     * @param WC_Product $product
     * @return array    ['rate'=> <float>, 'label'=> <string>, 'shipping'=> <string>, 'compound' => <string>]
     */
    public static function getVatRate(WC_Product $product): array|null
    {
        $tax_class = $product->get_tax_class();
        $rates = self::taxRatesForShopLocation($tax_class);

        return $rates[array_key_first($rates)];
    }


    public static function taxRatesForShopLocation(string $tax_class): array
    {
        $location = [
            WC()->countries->get_base_country(),
            WC()->countries->get_base_state(),
            WC()->countries->get_base_postcode(),
            WC()->countries->get_base_city()
        ];

        return WC_Tax::get_rates_from_location($tax_class, $location);
    }

    public static function createPosts(string $title_of_the_page): int
    {
        if (
            $page_obj = get_page_by_title(
                $title_of_the_page,
                'OBJECT',
                'page'
            )
        ) {
            return $page_obj->ID;
        }

        $page_id = wp_insert_post(
            array(
                'comment_status' => 'close',
                'ping_status'    => 'close',
                'post_author'    => 1,
                'post_title'     => ucwords($title_of_the_page),
                'post_name'      => strtolower(str_replace(' ', '-', trim($title_of_the_page))),
                'post_status'    => 'publish',

                'post_type'      => 'page',
                //'id_of_the_parent_page_if_it_available'
            )
        );

        return $page_id;
    }

    public static function errorHandler($error)
    {
        if (is_wp_error($error)) {
            exit($error->get_error_message());
        }
    }

    /**
     * Checks  if the cart needs shipment and shipment cost has been calculated
     *
     * @return bool
     */
    public static function isCartShipmentReady(): bool
    {
        if (!WC()->cart->needs_shipping()) {
            return true;
        } elseif (
            WC()->cart->show_shipping || ('yes' === get_option('woocommerce_enable_shipping_calc'))
        ) {
            return true;
        } else {
            return false;
        }
    }
}
