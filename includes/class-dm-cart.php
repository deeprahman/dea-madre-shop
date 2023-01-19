<?php

defined('ABSPATH') || exit;

if (!class_exists('DM_Cart')) :

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


        public static function init(array $params): self
        {
            return new Self($params);
        }

        public function __construct(array $params)
        {
            $this->woo = $params['wc'];
            $this->cartUrl = $params['cartUrl'];
        }

        protected function generateCartItemData():array
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
                $tmp['quantity'] = $this->$cart_item['quantity'];
                $tmp['subtotal'] = $this->woo->cart->get_product_subtotal( $_product, $cart_item['quantity'] );
                $tmp['cartUrl'] = $this->cartUrl; // Send coupon code to this url
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

        protected function cartTotalBreakUp():array
        {
            
        }
    }
endif;
