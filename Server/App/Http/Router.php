<?php

namespace Src\Server\App\Http;

class Router {

    private const BASE_CONTROLLER_NAMESPACE = 'App\Http\Controller';

    public function init(){ 

        $controllerName = $this->getRouteController();
        
        
        if(class_exists($controllerName)){
            $controller = new $controllerName;
            if($controller instanceof \App\Http\Controller\BaseController){
                $method = mb_strtolower($_SERVER['REQUEST_METHOD']);
                if(in_array($method, get_class_methods($controller))) {
                        return $controller->{$method}();
                }
            }
        }
        http_response_code(404);
        echo '404';
        exit;

    }

    /**
     * @return string
     */
    private function getRouteController(): string
    {
        $uri = explode('?', $_SERVER["REQUEST_URI"])[0];           
        $uri = trim($uri,'/');
        $uri = str_replace('/', ' ', $uri);
        $uri = ucwords($uri);
        $uri = str_replace(' ', '\\', $uri);

        $controller = self::BASE_CONTROLLER_NAMESPACE."\\{$uri}Controller";   
        if($controller === self::BASE_CONTROLLER_NAMESPACE.'\\Controller') {
            $controller = str_replace('Controller\Controller', 'Controller\IndexController', $controller);          
        }
        
        return $controller;
    }
}