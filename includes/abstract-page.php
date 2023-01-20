<?php

abstract class Page
{

    /**
     * Array containing data to be passed ot the webpack js
     *
     * @var array
     */
    protected $dmObject;

    protected $pageName;

    protected function initialize($page_name)
    {
        $this->setPageName($page_name);
        $this->setDmObject(['pageName' => $this->pageName]);

        
        $this->loadScripts();
        
    }

    /**
     * Sets the pageName  property
     *
     * @param string $page_name
     * @return self
     */
    abstract protected function setPageName(string $page_name):self;

    /**
     * Creates an AJAX handler
     *
     * @param array $params  example value [ 'action_name'=> 'my_action', 'nonce_identifier' => "my_nonce", 'callback'=>[this,'myCallback']]
     * @return void
     */
    protected function handleAjax(array $params)
    {
        $hook_logged_off = 'wp_ajax_nopriv_' . $params['action_name'];
        $hook_logged = 'wp_ajax_' . $params['action_name'];

        add_action($hook_logged_off, $params['callback']);

        add_action($hook_logged, $params['callback']);

        //send nonce value to the respective js file

    }


    public function loadScripts()
    {
        add_action('wp_enqueue_scripts', [$this, 'webpackScripts'],10);
    }

    public function webpackScripts()
    {
        $cssFileURI = get_template_directory_uri() . '/dist/css/main.min.css';
        wp_enqueue_style('dea-madre-css', $cssFileURI);


        $jsFileURI = get_template_directory_uri() . '/dist/js/main.min.js';
        wp_enqueue_script('dea-madre-js', $jsFileURI, array('jquery'), 1.0, true);

        $this->commonDataToBePassedToWebPackJs();

    }



    public function setDmObject($params = array()){
        $this->dmObject = [
            'siteUrl' => site_url()
        ];

       $this->dmObject = array_merge($this->dmObject, $params);
    }

    protected function commonDataToBePassedToWebPackJs(){

        if(
         !   wp_localize_script('dea-madre-js', 'dmObject', $this->dmObject)
        ){
            return new WP_Error(500, "Script Localization Failed");
        }
    }

    private function setDmObject(){
        $this->dmObject = [
            'siteUrl' => site_url()
        ];
    }

    protected function commonDataToBePassedToWebPackJs(){
        $this->setDmObject();
        if(
         !   wp_localize_script('dea-madre-js', 'dmObject', $this->dmObject)
        ){
            return new WP_Error(500, "Script Localization Failed");
        }
    }
}
