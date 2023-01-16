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
        return (float) (  $include_tax -  $exclude_tax );
    }

    /**
     * Get tax rates for a product
     *
     * @param WC_Product $product
     * @return array    ['rate'=> <float>, 'label'=> <string>, 'shipping'=> <string>, 'compound' => <string>]
     */
    public static function getVatRate(WC_Product $product):array
    {
        $tax_class = $product->get_tax_class();
        $rates = self::taxRatesForShopLocation($tax_class);
        
        return $rates[array_key_first($rates)];
    }


    public static function taxRatesForShopLocation(string $tax_class):array{
        $location = [
            WC()->countries->get_base_country(),
            WC()->countries->get_base_state(),
            WC()->countries->get_base_postcode(),
            WC()->countries->get_base_city()
        ];

        return WC_Tax::get_rates_from_location($tax_class, $location);
    }
}
