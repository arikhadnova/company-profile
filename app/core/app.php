<?php
// app/core/App.php

class App {
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        // Log Visitor Hit
        require_once dirname(__DIR__) . '/models/Visitor_model.php';
        $visitorModel = new Visitor_model();
        $visitorModel->logHit();

        $url = $this->parseUrl() ?: [];

        $base = dirname(__DIR__); // app/

        // Check for controller (ensure index exists before accessing)
        if (isset($url[0]) && file_exists($base . '/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once $base . '/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Check for method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Get params
        if( !empty($url) ){
            $this->params = array_values($url);
        }

        // Call controller method with params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() 
    {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}