<?php

namespace ESGI\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ESGIUserBundle:Default:index2.html.twig', array('name' => $name));
    }

    public function registerAction($name)
    {
    	return $this->render('ESGIUserBundle:Default:index2.html.twig', array('name' => $name));
    }
}
