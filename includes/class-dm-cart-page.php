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
            add_filter('woocommerce_registration_error_email_exists', [$this, 'filterRegErrorEmailExists'], 10, 2);
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
            wc_clear_notices();
            $result = [];

            check_ajax_referer(
                $this->getAjaxParams()['nonce_identifier'],
                'nonce'
            );
            $result['newNonce'] = wp_create_nonce($this->getAjaxParams()['nonce_identifier']);
            $action = wc_get_var($_REQUEST['cart_action'], '');
            switch ($action) {
                case 'account-check':
                    $this->primaryConfirmation($result);
                    break;
                case 'shipping-form':
                    $this->ShippingAddressForm($result);
                    break;
                case 'states-for-country':
                    $this->fetchStatesNames($result);
                    break;
                case 'shipping-method':
                    $this->shippingMethods($result);
                    break;
                case 'save-shipping-form':
                    $this->saveShippingAddress();
                    break;
                case 'billing-form':
                    $this->billingAddressForm($result);
                    break;
                default:
                    wp_send_json_error(
                        esc_html_e('Unknown Action', 'deamadre'),
                        404
                    );
                    exit;
            }
            $result['notice'] = wc_get_notices();
            wp_send_json_success($result);
        }

        private function primaryConfirmation(&$result)
        {
            $result['cartShipmentOk'] = DM_Utilities::isCartShipmentReady();
            $result['isLoggedIn'] = is_user_logged_in();
            $result['did'] = 'account-checking';
            if (!($result['isLoggedIn'] = is_user_logged_in())) {
                wc_add_notice(__('User Is Not logged in'), 'warning');
                if (is_email($_POST['email'])) {
                    DM_Utilities::registerAccountWIthEmail($_POST['email']);
                } else {
                    wc_add_notice(__('Email is not set'), 'Warning');
                }
            }
        }

        public function filterRegErrorEmailExists($message, $email)
        {
            $link = "<strong>Message</strong>: Account exists please log in " . '<a href="' . get_permalink(get_page_by_title('My Account')) . '">Log In</a>';
            return __($link, 'deamadre');
        }

        /**
         * Handles all requests related to shipping address form on the cart page
         *
         * @return void
         */
        public function shippingAddressForm(&$result)
        {
            $result['did'] = 'shipment-address-data-fetching';
            $result['address_data'] = $this->getFormData('shipping');

        }

        private function saveShippingAddress()
        {
            $uid = get_current_user_id();
            DM_Utilities::errorHandler($as = new DM_Address_Saver($uid));
            if ($as->save_address()) {
                wc_add_notice(__('Shipment Address Saved'), 'deamadre');
                return;
            }
            wc_add_notice(__('Shipment Address Not Saved'), 'deamadre');
        }

        private function getFormData($type): array
        {
            return DM_Utilities::getAddressData($type);
        }

        /**
         * Handles all requests related to select on shipping method
         *
         * @return void
         */
        public function shippingMethods(&$result)
        {
            // TODO: code for handling requests for displaying shipping methods

            // TODO: code for handling requests for shaving shipping methods
        }

        /**
         * Handle all requests related to the billing address form
         *
         * @return void
         */
        public function billingAddressForm(&$result)
        {
            // TODO: Code for handling requests for displaying the billing address form

            // TODO: Code for handling requests for saving billing address
        }

        private function fetchStatesNames(&$result)
        {
            if (!isset($_REQUEST['countryCode'])) {
                wp_send_json_error(
                    esc_html_e('countryCode field is not set', 'deamadre'),
                    404
                );
                exit;
            }

            $result['states'] = WC()->countries->get_states(
                sanitize_text_field($_REQUEST['countryCode'])
            );
        }
    }

endif;
