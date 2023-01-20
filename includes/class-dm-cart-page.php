<?php

defined('ABSPATH') || exit;

if (!class_exists('DM_Cart_Page')) :

    class DM_Cart_Page extends Page
    {

        /**
         * @var DM_cart
         */
        private $cart;

        public function __construct()
        {
            $this->setCart();
            $this->initialize('cart');
            
            // exit(var_dump($this->cart->getTotal()));
        }
        
        public function setCart(){
            if(
                file_exists($file = INC_DIR. DIRECTORY_SEPARATOR . 'class-dm-cart.php')
            ){
                require_once $file;
                $this->cart = new DM_Cart(WC(),[]);
            }
        }

        protected function setPageName(string $page_name): self
        {
            $this->pageName = $page_name;
            return $this;
        }

        
    }

endif;
