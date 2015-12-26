<?php

namespace TestCase\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Class Controller
 *
 * Base controller for our application. Other controllers should extend it to use some helper functions.
 *
 * @package TestCase\Controllers
 */
abstract class Controller
{
    /**
     * @param string $templatePath PAth to twig templates
     * @param array $args Arguments to send to template
     * @return Response
     */
    protected function render($templatePath, $args)
    {
        $loader = new Twig_Loader_Filesystem(__DIR__.'/../../public/resources/views/');
        $twig = new Twig_Environment($loader);

        return new Response($twig->render($templatePath, $args), 200);
    }
}