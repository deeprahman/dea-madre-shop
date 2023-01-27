<?php

declare(strict_types=1);

class DM_Shop_Page extends Page
{
    /**
     * The instance of the DM_Product_List class
     *
     * @var DM_Product_List
     */
    private $PL;

    public function __construct()
    {
        $this->setPL(['limit' => -1]);
        $this->initialize('shop');
        $this->setParams()->handleAjax($this->getAjaxParams());

        add_action('wp_enqueue_scripts', [$this, 'sendNonceToJsFile'], 20);
    }

    protected function setPageName(string $page_name): self
    {
        $this->pageName = $page_name;
        return $this;
    }

    private function setPL($params = null)
    {
        require_once INC_DIR . DIRECTORY_SEPARATOR . "class-product-list.php";
        $this->PL = new DM_Product_List($params);
    }
    public function getPL(): DM_Product_List
    {
        return $this->PL;
    }

    public static function init()
    {
        new self();
    }
    
    private function setParams()
    {

        $this->setAjaxParams('shop_data', 'shop_data_nonce', [$this, 'getProductData']);
        return $this;
    }

    public function getProductData()
    {
        // The nonce
        check_ajax_referer(
            $this->getAjaxParams()['nonce_identifier'],
            'nonce'
        );
        $products = $this->getPL()->getProducts();

        wp_send_json_success($products);
    }


}
