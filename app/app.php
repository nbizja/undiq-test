<?php
namespace TestCase;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use TestCase\Controllers;

$routes = new RouteCollection();

$routes->add('page1', new Route('/page1', array(
    '_controller' => [new Controllers\PageController(), 'showPage1']
)));

$routes->add('page2', new Route('/page2', [
    '_controller' => [new Controllers\PageController(), 'showPage2']
]));

return $routes;