<?php

defined('ABSPATH') || exit;

if (!class_exists('DM_Cart_Page')) :

    class DM_Cart_Page extends Page
    {

        /**
         * @var DM_cart
         */
        private $dmCart;

        public function __construct()
        {
            $this->setCart();
            $this->initialize('cart');
            $this->setParams()->handleAjax($this->getAjaxParams());

            add_action('wp_enqueue_scripts', [$this, 'sendNonceToJsFile'], 20);

            // exit(var_dump($this->dmCart->getCartInfo()));
        }

        public function setCart()
        {
            if (
                file_exists($file = INC_DIR . DIRECTORY_SEPARATOR . 'class-dm-cart.php')
            ) {
                require_once $file;
                $this->dmCart = new DM_Cart(WC(), []);
            }
        }

        protected function setPageName(string $page_name): self
        {
            $this->pageName = $page_name;
            return $this;
        }

        private function setParams()
        {

            $this->setAjaxParams('dm_cart_confirmation', 'cart_confirmation_nonce', [$this, 'shouldProceedToCheckout']);
            return $this;
        }

        public function shouldProceedToCheckout()
        {
            $result = [];
            // The nonce
            check_ajax_referer(
                $this->getAjaxParams()['nonce_identifier'],
                'nonce'
            );
            $result['cartShipmentOk'] = DM_Utilities::isCartShipmentReady();
            $result['isLoggedIn'] = is_user_logged_in();
            wp_send_json_success($result);
        }
    }

endif;
