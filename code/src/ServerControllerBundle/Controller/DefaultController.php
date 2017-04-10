<?php

namespace ServerControllerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ServerControllerBundle:Default:index.html.twig');
    }
}
