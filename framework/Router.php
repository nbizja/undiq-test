<?php

namespace Framework;


use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

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
     * @param string $name The route name
     * @param Route $route A Route instance
     */
    public function addManually($name, Route $route)
    {
        $this->routes->add($name, $route);
    }

    /**
     * @param string $method GET,POST,PUT,PATCH,DELETE
     * @param string $path path in url
     * @param String|Object $controller Controller to be called if match is found for this route.
     * @param array $routeConfig Array with config values for Route class.
     * Keys: defaults, requirements, options, host, schemes, methods, condition, name
     */
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
            $routeConfig['name'],
            new Route(
                $path,
                $routeConfig['defaults'],
                $routeConfig['requirements'],
                $routeConfig['options'],
                $routeConfig['host'],
                $routeConfig['schemes'],
                $routeConfig['methods'],
                $routeConfig['condition']
            )
        );

    }

    /**
     * Register route for GET method
     *
     * @param string $path path in url
     * @param string|Object $controller Controller to be called if match is found for this route.
     * @param array $routeConfig Array with config values for Route class.
     * Keys: defaults, requirements, options, host, schemes, methods, condition, name
     */
    public function get($path, $controller, array $routeConfig = [])
    {
        $this->add('GET', $path, $controller, $routeConfig);
    }

    /**
     * Register route for POST method
     *
     * @param string $path path in url
     * @param string|Object $controller Controller to be called if match is found for this route.
     * @param array $routeConfig Array with config values for Route class.
     * Keys: defaults, requirements, options, host, schemes, methods, condition, name
     */
    public function post($path, $controller, array $routeConfig = [])
    {
        $this->add('POST', $path, $controller, $routeConfig);
    }

    /**
     * Register route for PUT method
     *
     * @param string $path path in url
     * @param string|Object $controller Controller to be called if match is found for this route.
     * @param array $routeConfig Array with config values for Route class.
     * Keys: defaults, requirements, options, host, schemes, methods, condition, name
     */
    public function put($path, $controller, array $routeConfig = [])
    {
        $this->add('PUT', $path, $controller, $routeConfig);
    }

    /**
     * Register route for PATCH method
     *
     * @param string $path path in url
     * @param string|Object $controller Controller to be called if match is found for this route.
     * @param array $routeConfig Array with config values for Route class.
     * Keys: defaults, requirements, options, host, schemes, methods, condition, name
     */
    public function patch($path, $controller, array $routeConfig = [])
    {
        $this->add('PATCH', $path, $controller, $routeConfig);
    }

    /**
     * Register route for DELETE method
     *
     * @param string $path path in url
     * @param string|Object $controller Controller to be called if match is found for this route.
     * @param array $routeConfig Array with config values for Route class.
     * Keys: defaults, requirements, options, host, schemes, methods, condition, name
     */
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