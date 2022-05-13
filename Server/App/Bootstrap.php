<?php

namespace App;

/**
 * Class Boostrap
 *
 * @package App
 */
class Bootstrap
{

    /**
     * @var Http\Router
     */
    private Http\Router $router;

    public function __construct()
    {
        $this->router = new Http\Router();
    }


    public function run()
    {
        return $this->initRoutes();
    }

    /**
     * @return $this
     */
    private function initRoutes(): self
    {
        $this->router->init();
        return $this;
    }
}