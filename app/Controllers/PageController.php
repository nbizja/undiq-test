<?php

namespace TestCase\Controllers;

use \Symfony\Component\HttpFoundation\Request;

/**
 * Class PageController
 *
 * @package TestCase\Controllers
 */
class PageController extends Controller
{
    public function showPage1()
    {
        return $this->render('page1.html.twig', []);
    }

    public function showPage2(Request $request)
    {
        return $this->render('page2.html.twig', ['paragraph' => $request->request->get('message_to_world')]);
    }
}