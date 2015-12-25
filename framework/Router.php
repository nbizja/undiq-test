<?php

namespace Framework;


use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class Router
{
    private $routes;
    /**
     * Default config for Route
     *
     * @var $defaultRouteConfig .
     * @param array $defaults An array of default parameter values
     * @param array $requirements An array of requirements for parameters (regexes)
     * @param array $options An array of options
     * @param string $host The host pattern to match
     * @param string|array $schemes A required URI scheme or an array of restricted schemes
     * @param string|array $methods A required HTTP method or an array of restricted methods
     * @param string $condition A condition that should evaluate to true for the route to match
     */
    private $defaultRouteConfig;

    public function __construct(RouteCollection $routeCollection)
    {
        $this->routes = $routeCollection;
        $this->defaultRouteConfig = [
            'defaults' => [],
            'requirements' => [],
            'options' => [],
            'host' => '',
            'schemes' => [],
            'methods' => [],
            'condition' => '',
            'name' => '',
        ];
    }

    /**
     * Adds a route.
     *
     * @param string $name  The route name
     * @param Route  $route A Route instance
     */
    public function addManually($name, Route $route)
    {
        $this->routes->add($name, $route);
    }

    public function add($method, $path, $controller, array $routeConfig = [])
    {
        $routeConfig = array_merge($this->defaultRouteConfig, $routeConfig);
        $routeConfig['methods'] = [$method];
        $routeConfig['path'] = $path;
        $routeConfig['defaults']['_controller'] = $controller;
        if ($routeConfig['name'] == '') {
            $routeConfig['name'] = $path.'_'.$method;
        }

        $this->addManually(
            $routeConfig['name'], new Route(
            $path,
            $routeConfig['defaults'],
            $routeConfig['requirements'],
            $routeConfig['options'],
            $routeConfig['host'],
            $routeConfig['schemes'],
            $routeConfig['methods'],
            $routeConfig['condition']
        ));

    }

    public function get($path, $controller, array $routeConfig = [])
    {
        $this->add('GET', $path, $controller, $routeConfig);
    }

    public function post($path, $controller, array $routeConfig = [])
    {
        $this->add('POST', $path, $controller, $routeConfig);
    }

    public function put($path, $controller, array $routeConfig = [])
    {
        $this->add('PUT', $path, $controller, $routeConfig);
    }

    public function patch($path, $controller, array $routeConfig = [])
    {
        $this->add('PATCH', $path, $controller, $routeConfig);
    }

    public function delete($path, $controller, array $routeConfig = [])
    {
        $this->add('DELETE', $path, $controller, $routeConfig);
    }

    /**
     * @return RouteCollection
     */
    public function getRoutes()
    {
        return $this->routes;
    }

}