<?php

namespace ESGI\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query;
use Doctrine\Common\Collection\ArrayCollection;
use Doctrine\ORM\QueryBuilder;

use ESGI\BlogBundle\Entity\Post as Post;
use ESGI\BlogBundle\Form\ProposePostType;

class PostController extends Controller
{

    /**
     * @Template()
     */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('ESGIBlogBundle:Post')->findAll();

        return [
        	'posts' => $posts,
        ];
	}

	/**
     * @Template()
     */
	public function listAction(Request $request)
	{
	    $em    = $this->get('doctrine.orm.entity_manager');
	    $dql   = "SELECT a FROM ESGIBlogBundle:Post a";
	    $query = $em->createQuery($dql);

	    $paginator  = $this->get('knp_paginator');
	    $pagination = $paginator->paginate(
	        $query,
	        $request->query->get('page', 1)/*page number*/,
	        10/*limit per page*/
	    );

	    // parameters to template
	    return [
	    	'pagination' => $pagination
	    ];
	}


}