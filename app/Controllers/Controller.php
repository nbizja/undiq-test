<?php

namespace TestCase\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Twig_Loader_Filesystem;
use Twig_Environment;

abstract class Controller
{
    protected function render($templatePath, $args)
    {
        $loader = new Twig_Loader_Filesystem(__DIR__.'/../../resources/views/');
        $twig = new Twig_Environment($loader);

        return new Response($twig->render($templatePath, $args), 200);
    }
}