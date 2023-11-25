<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App;

use App\Helpers\Generators\RouteGenerator;
use App\Helpers\Managers\SessionManager;
use Phroute\Phroute\{Dispatcher, RouteCollector as Router, RouteParser};

class Kernel
{
    public Router $router;
    private Dispatcher $dispatcher;
    private Mixed $response;
    public function create()
    {
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr', 'French_France');

        $router = new Router(new RouteParser());
        $this->router = $router;

        $routeGenerator = new RouteGenerator($router);
        require_once dirname(__DIR__) . '/routes/web.php';

        $dispatcher = new Dispatcher($router->getData());
        $this->dispatcher = $dispatcher;

        $locale = 'fr_FR';
        $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], \PHP_URL_PATH, $locale);
        $this->response = $response;
    }

    public function run()
    {
        $response = $this->response;
        echo $response;
    }
}