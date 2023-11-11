<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Helpers\Generators;

use App\Kernel;

class RouteGenerator
{
    private Mixed $router;
    public function __construct($router)
    {
        $this->router = $router;
    }

    public function generateRoute($method, $uri, $controller, $function)
    {
        $this->router->$method($uri, [$controller, $function]);
    }

    public function generateCouple($uri, $controller, $function)
    {
        $this->router->get($uri, [$controller, $function]);
        $this->router->post($uri, [$controller, $function]);
    }
}