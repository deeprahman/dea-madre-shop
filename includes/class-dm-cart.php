<?php

defined('ABSPATH') || exit;

if (!class_exists('DM_Cart')) :

    /**
     * Contains methods to be used in WooCommerce cart template
     */
    class DM_Cart
    {
        /**
         * WC object
         *
         * @var WC
         */
        protected $woo;

        /**
         * the cart url
         * 
         * @var string
         */
        protected $cartUrl;




        public function __construct(WooCommerce $wc,array $params)
        {
            $this->woo = $wc;
            $this->cartUrl = ($params['cartUrl'])?:wc_get_cart_url();
        }

        public function getCartItems():array{
            return $this->generateCartItemData();
        }

        public function getCartUrl():string{
            return $this->cartUrl;
        }

        public function getTotal():array{
            return $this->cartTotalBreakUp();
        }

        /**
         * returns cart url, cart total and item data
         *
         * @return array  ['cart_url' => `string`, 'cart_items' => `array`, 'cart_amount' => `array`]
         */
        public function getAllCartData():array{
            return [
                'cart_url' => $this->getCartUrl(),
                'cart_items' => $this->getCartItems(),
                'cart_amount' => $this->getTotal()
            ];
        }

        protected function generateCartItemData(): array
        {
            $result = [];
            foreach ($this->woo->cart->get_cart() as $cart_item_key => $cart_item) {
                $tmp = [];
                $_product = $cart_item['data'];

                $tmp['permalink'] = $this->getProductPermalink($_product, $cart_item);
                $tmp['removalLink'] = wc_get_cart_remove_url($cart_item_key);
                $tmp['thumbnail'] = $_product->get_image();
                $tmp['itemName'] = $_product->get_name();
                $tmp['formattedData'] = wc_get_formatted_cart_item_data($cart_item);
                $tmp['backOrderNotification'] = $this->backOrderNotification($_product, $cart_item);
                $tmp['price'] = $this->woo->cart->get_product_price($_product);
                $tmp['quantity'] = $cart_item['quantity'];
                $tmp['subtotal'] = $this->woo->cart->get_product_subtotal($_product, $cart_item['quantity']);
                $tmp['cartUrl'] = $this->cartUrl; // Send coupon code to this url
                $tmp['cartItemKey'] = $cart_item_key;
                array_push($result, $tmp);
            }
            return $result;
        }

        private function getProductPermalink(WC_Product $_product, array $cart_item): string
        {
            if ($_product && $_product->exists() && $cart_item['quantity'] > 0) {
                return $_product->is_visible() ? $_product->get_permalink($cart_item) : '';
            }
            return '';
        }

        private function backOrderNotification(WC_Product $_product, array $cart_item): string
        {
            if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                return esc_html('Available on backorder', 'deamadre');
            }
            return '';
        }

        protected function cartTotalBreakUp(): array
        {
            $ret = [];
            $ret['subtotal'] = wc_cart_totals_subtotal_html();
            $ret['coupons'] = $this->calculateForCoupons();
            $ret['shippingInfo'] = $this->calculateForShipping();
            $ret['taxDetails'] = $this->calculateForTax();
            $ret['grossTotal'] = wc_cart_totals_order_total_html();
            return $ret;
        }

        private function calculateForCoupons()
        {
            $coupons = [];
            foreach ($this->woo->cart->get_coupons() as $code => $coupon) {
                $coupons[$code] = wc_cart_totals_coupon_html($coupon);
            }
            return $coupons;
        }

        private function calculateForShipping(): string
        {

            if ($this->woo->cart->needs_shipping() && $this->woo->cart->show_shipping()) {
                return wc_cart_totals_shipping_html();
            } else if ($this->woo->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) {
                return woocommerce_shipping_calculator();
            } else {
                return '';
            }
        }

        private function calculateForTax(): array
        {
            $result = [];
            if (wc_tax_enabled() && !$this->woo->cart->display_prices_including_tax()) {
                $taxable_address = $this->woo->customer->get_taxable_address();
                $estimated_text  = '';

                if ($this->woo->customer->is_customer_outside_base() && !$this->woo->customer->has_calculated_shipping()) {
                    /* translators: %s location. */
                    $result['estimatedText'] = $estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', $this->woo->countries->estimated_for_prefix($taxable_address[0]) . $this->woo->countries->countries[$taxable_address[0]]);
                }

                if ('itemized' === get_option('woocommerce_tax_total_display')) {
                    $result['itemized'] = [];
                    foreach ($this->woo->cart->get_tax_totals() as $code => $tax) {
                        $tmp = [];
                        $tmp['taxLabel'] = $tax->label;
                        $tmp['taxAmount'] = $tax->formatted_amount;
                        array_push($result['itemized'], $tmp);
                    }
                } else {

                    $result['not_itemized'] = ['tax_label' => $this->woo->countries->tax_or_vat(), 'taxAmount' => wc_cart_totals_taxes_total_html()];
                }
            }

            return $result;
        }
    }
endif;
