<?php

final class DM_Dea_Madre
{

    /**
     * Contains Dea Madre Valid pages
     *
     * @var array
     */
    private $pageNames;

    public function __construct(array $params)
    {
        DM_Utilities::errorHandler($this->checkEnvironment());
        $this->initProperties($params);
    }

    private function initProperties($params): self
    {
        $this->setPageNames($params['pages']);
        return $this;
    }

    private function checkEnvironment() // requires WordPress 5.5
    {
        if ('production' === wp_get_environment_type() && 'https' !== $_SERVER['REQUEST_SCHEME']) {
            return new WP_Error(500, 'SSL is not active');
        }
    }


    private function setPageNames($page_names)
    {
        $this->pageNames = $page_names;
    }

    public function main()
    {

        add_action('after_switch_theme', [$this, 'necessaryPages'], 10); // Create pages at theme activation
        add_action('after_setup_theme', [$this, 'changeToPrettyPermalinks'], 20);
        add_action('parse_request', [$this, 'pageClassLoader'], 10);  // Load Classes as per request
        $this->loadHooks();
        $this->handleXmlHttp();
    }

    public function necessaryPages()
    {

        foreach ($this->pageNames as $page_name) {
            DM_Utilities::createPosts($page_name);
        }
    }


    private function loadHooks()
    {
        global $dea_madre;
        // Hook Related
        require_once INC_DIR . DIRECTORY_SEPARATOR . "custom-hooks" . DIRECTORY_SEPARATOR . 'remove-hooks.php';
        require_once INC_DIR . DIRECTORY_SEPARATOR . 'custom-hooks/class-dm-hook-methods.php';

        require_once INC_DIR . DIRECTORY_SEPARATOR . "custom-hooks" . DIRECTORY_SEPARATOR . 'hooks.php'; // Add custom hooks
    }

    public function pageClassLoader(WP $wp): Page|WP_Error
    {

        if (isset($wp->query_vars['pagename'])) {
            return $this->instantiatePageClass($wp->query_vars['pagename']);
        } elseif ($page = $this->isValidPage($wp->request)) {
            return $this->instantiatePageClass($page);
        } else {

            return $this->instantiatePageClass('home');
        }
    }

    public function instantiatePageClass(string $page): Mixed
    {
        require_once INC_DIR . DIRECTORY_SEPARATOR . 'abstract-page.php';
        $full_file_name = INC_DIR .  DIRECTORY_SEPARATOR . 'class-dm-' . strtolower($page) . '-page.php';
        if (!file_exists($full_file_name)) {
            return new WP_Error(404, 'file ' . $full_file_name . ' not found');
        }
        require_once $full_file_name;
        $page = preg_replace('/-/','_',$page)?:$page;
        $page_name = ucwords($page, '_');
        $class_name = 'DM_' . $page_name . '_Page';
        return new $class_name();
    }

    private function isValidPage(string $request): string
    {
        if (
            false !== ($index = array_search($request, $this->pageNames))
        ) {
            return $this->pageNames[$index];
        }
        return '';
    }

    protected function handleXmlHttp()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $ret_obj = new WP_Error(404, "Invalid XMLHttpRequest");
            $referer = $_SERVER['HTTP_REFERER'];
            $matches = [];
            foreach ($this->pageNames as $name) {
                $reg_ex = "/\/(" . $name . ")(\/)?/";
                if (1 === preg_match($reg_ex, $referer, $matches)) {
                    $ret_object = $this->instantiatePageClass($matches[1]);
                }
            }
            return $ret_object;
        }
    }

    public function changeToPrettyPermalinks()
    {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
        $wp_rewrite->flush_rules();
    }
}
