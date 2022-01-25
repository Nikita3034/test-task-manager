<?php

namespace App\Controllers;

use App\Controllers\AuthController;

class MainController
{
    use \App\Traits\PaginationTrait;

    private static $controller;
    private $authContoller;

    private $routeWeb;
    private $routeApi;

    private $ajax;

    public function __construct($route)
    {
        $this->authContoller = new AuthController($this);

        $this->routeWeb = $route['web'];
        $this->routeApi = $route['api'];

        // check if request is ajax
        $this->ajax = $this->isAjax();

        // load current page
        $this->load();
    }

    /**
     * Loading page
     *
     * @return void
     */
    private function load()
    {
        $url = parse_url($_SERVER['REQUEST_URI'])['path'];

        // get response class for api or web 
        $response = $this->ajax ? $this->routeApi[$url] : $this->routeWeb[$url];

        if (empty($response)) {
            return $this->ajax ? false : $this->getPage404();
        }

        list($class, $method) = explode('::', $response);

        $result = $this->callMethod($class, $method);

        if ($this->ajax) {
            echo json_encode($result);
            die();
        }
    }

    /**
     * Call method by class
     *
     * @param [type] $class
     * @param [type] $method
     * @return void
     */
    private function callMethod($class, $method)
    {
        self::$controller = new $class($this);

        return self::$controller->$method();
    }

    /**
     * Front page rendering
     *
     * @return void
     */
    public function print($page)
    {
        // require header
        require_once VIEWS_PATH .'/header.tpl.php';

        // require body
        require_once VIEWS_PATH .'/'. $page .'/index.tpl.php';

        // require footer
        require_once VIEWS_PATH .'/footer.tpl.php';
    }

    /**
     * Get 404 page (when page not found)
     *
     * @return void
     */
    private function getPage404()
    {
        require_once VIEWS_PATH .'/page404.tpl.php';
        die();
    }

    /**
     * Check request is ajax
     *
     * @return boolean
     */
    private function isAjax(): bool
    {
        return
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
            ? true
            : false;
    }
}