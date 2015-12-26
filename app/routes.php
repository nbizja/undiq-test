<?php
namespace TestCase;

use Framework\Router;
use Symfony\Component\Routing\RouteCollection;
use TestCase\Controllers;

//Initialize Router to help with routes registration.
$router = new Router(new RouteCollection());

// Adding routes.
$router->get('page1', 'TestCase\\Controllers\\PageController::showPage1');

$router->post('page2', 'TestCase\\Controllers\\PageController::showPage2');

return $router->getRoutes();