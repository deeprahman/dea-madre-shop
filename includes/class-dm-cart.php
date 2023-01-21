<?php

defined('ABSPATH') || exit;

if (!class_exists('DM_Cart')) :

    /**
     * Contains methods to be used in WooCommerce cart template
     */
    class DM_Cart
    {
        /**
         * WooCommerce object
         *
         * @var WooCommerce
         */
        protected $woo;

        /**
         * the cart url
         * 
         * @var string
         */
        protected $cartUrl;

        /**
         * Net subtotal of the cart items
         *
         * @var float
         */
        protected $cartSubtotal;

        public function __construct(WooCommerce $wc,array $params)
        {
            $this->initiateProperties($wc, $params);
            $this->initiateMethods($wc, $params);
        }

        private function initiateProperties(WooCommerce $wc,array $params){
            $this->woo = $wc;
            $this->cartUrl = ($params['cartUrl'])?:wc_get_cart_url();
            $this->cartSubtotal = 0.0;

        }

        private function initiateMethods(WooCommerce $wc,array $params){

        }

        /**
         * Generates current cart info
         *
         * @return array  ['individualItemInfo' => `array`, 'cart'=> `totals`]
         */
        public function getCartInfo():array{
            $result = [];
            $result['individualItemInfo'] = $this->generateCartItemData();
            $result['cartSubTotal'] = $this->cartSubtotal;
            return $result;
        }




        private function generateCartItemData(): array
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

                $this->cartSubtotal += $cart_item['line_subtotal'];
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

    }
endif;
