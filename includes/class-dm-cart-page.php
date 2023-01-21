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
            
            // exit(var_dump($this->dmCart->getCartInfo()));
        }
        
        public function setCart(){
            if(
                file_exists($file = INC_DIR. DIRECTORY_SEPARATOR . 'class-dm-cart.php')
            ){
                require_once $file;
                $this->dmCart = new DM_Cart(WC(),[]);
            }
        }

        protected function setPageName(string $page_name): self
        {
            $this->pageName = $page_name;
            return $this;
        }

        
    }

endif;
