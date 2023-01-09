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
        $this->setPL(['limit'=> -1]);
        $this->initialize();
        $this->setParams()->handleAjax($this->getParams());

        add_action('wp_enqueue_scripts', [$this,'sendNonceToJsFile'],20);
    }

    private function setPL($params = null){
        require_once INC_DIR . DIRECTORY_SEPARATOR . "class-product-list.php";
        $this->PL = new DM_Product_List($params);
    }
    public function getPL():DM_Product_List{
        return $this->PL;
    }
    public static function init()
    {
        new self();
    }
    private function setParams()
    {
        $this->params = [
            'action_name' => 'shop_data',
            'nonce_identifier' => 'shop_data_nonce',
            'callback' => [$this, 'getProductData']
        ];
        return $this;
    }

    private function getParams(): array
    {
        return $this->params;
    }


    public function getProductData()
    {

        // The nonce
        $tmp =check_ajax_referer(
            $this->getParams()['nonce_identifier'],
            'nonce'
        );
       $products = $this->getPL()->getProducts();

        wp_send_json_success($products);
    }

    public function sendNonceToJsFile(){

        $nonce = wp_create_nonce($this->getParams()['nonce_identifier']);
        $is_localized =        wp_localize_script('dea-madre-js', 'shopObject', ['nonce' => $nonce]);
        if(! $is_localized){
            return new WP_Error(500, "Script Localization Failed");
        }
    }
}
