<?php

// example.com/web/front.php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Framework\Framework;

//Parse request
$request = Request::createFromGlobals();

//Load routes
$routes = include __DIR__.'/../app/routes.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();

$framework = new Framework($matcher, $resolver);
$response = $framework->handle($request);

$response->send();