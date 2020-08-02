<?php

namespace App\Core;

class Router 
{
    private static $instance;
    private $controllerPrefix = 'App\\Controllers\\';

    private function __clone() {}

    private function __construct() {}

    public static function getInstance() : Router
    {
        if(Router::$instance === null) {
            Router::$instance = new Router();
        }
        return Router::$instance;
    }

    public function find(string $path)
    {
        $controllerName = ucfirst(explode('/', trim($path, '/'))[0] ?: 'Main');
        $actionName = 'action' . ucfirst(explode('/', trim($path, '/'))[1] ?: 'Index');
        
        $controller = "{$this->controllerPrefix}{$controllerName}Controller";
        if(!class_exists($controller)) {
            $controller = "{$this->controllerPrefix}ErrorController";
            // or throw exception or call ErrorController forcibly
        }
        $controller = new $controller();
        if(!method_exists($controller, $actionName)) {
            $controller = "{$this->controllerPrefix}ErrorController";
            $actionName = 'actionIndex';
        }
        call_user_func(array($controller, $actionName));
    }
}
