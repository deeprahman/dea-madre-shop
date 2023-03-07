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

    private $ajaxParams;

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
    abstract protected function setPageName(string $page_name): self;

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
    }


    public function loadScripts()
    {
        add_action('wp_enqueue_scripts', [$this, 'webpackScripts'], 10);
    }

    public function webpackScripts()
    {
        $cssFileURI = get_template_directory_uri() . '/dist/css/main.min.css';
        wp_enqueue_style('dea-madre-css', $cssFileURI);


        $jsFileURI = get_template_directory_uri() . '/dist/js/main.min.js';
        wp_enqueue_script('dea-madre-js', $jsFileURI, array('jquery'), 1.0, true);

        $this->commonDataToBePassedToWebPackJs();
    }



    public function setDmObject($params = array())
    {
        $this->dmObject = [
            'siteUrl' => site_url()
        ];

        $this->dmObject = array_merge($this->dmObject, $params);
    }

    protected function commonDataToBePassedToWebPackJs()
    {

        if (
            !wp_localize_script('dea-madre-js', 'dmObject', $this->dmObject)
        ) {
            return new WP_Error(500, "Script Localization Failed");
        }
    }

    protected function removeWooCommerceStyles()
    {
        add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    }

    /**
     * Sets the ajax params
     *
     * @param string $action_name   The name of the ajax action to be triggered
     * @param string $nonce_identifier the name to be used for creating nonce
     * @param array $callback   the method to be called when the ajax action gets triggered
     * @return self
     */
    protected function setAjaxParams(string $action_name, string $nonce_identifier, array $callback): self
    {
        $this->ajaxParams = [
            'action_name' => $action_name,
            'nonce_identifier' => $nonce_identifier,
            'callback' => $callback
        ];
        return $this;
    }

    /**
     * Gets the value of the ajaxParams property
     *
     * @return array
     */
    protected function getAjaxParams(): array
    {
        return $this->ajaxParams;
    }

    /**
     * Undocumented function
     *
     * @param string|null $js_object
     * @return void
     */
    public function sendNonceToJsFile(string $js_object = null)
    {
        $js_object = ($js_object) ?: $this->pageName . 'Object';
        $nonce = wp_create_nonce($this->getAjaxParams()['nonce_identifier']);
        $is_localized =        wp_localize_script('dea-madre-js', $js_object, ['nonce' => $nonce]);
        if (!$is_localized) {
            return new WP_Error(500, "Script Localization Failed");
        }
    }

    /**
     * Registers the Ajax handlers
     *
     * @param array<array> $params  [ ['action' => `action name`, 'nonce_name' => `nonce name`, 'handler' => `array`] ]
     * @return void
     */
    protected function registerAjaxHandlers(array $params)
    {
        foreach ($params as $param) {
            $this->setAjaxParams($param['action'], $param['nonce_name'], $param['handler']);
            $this->handleAjax($this->getAjaxParams());
        }
    }
}
