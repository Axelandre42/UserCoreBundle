<?php

namespace Axelandre42\User\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('Axelandre42UserCoreBundle:Default:index.html.twig');
    }
}
