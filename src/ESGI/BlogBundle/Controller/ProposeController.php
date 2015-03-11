<?php

namespace ESGI\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use ESGI\BlogBundle\Entity\Post as Post;
use ESGI\BlogBundle\Form\ProposePostType;

class ProposeController extends Controller
{
    /**
     * @Route("/propose")
     * @Template()
     */
	public function proposeAction(Request $request)
	{
		$post = new Post();
		$form = $this->createForm(new ProposePostType(),$post);

		if ( $request -> getMethod() == 'POST' ) {
			$form ->handleRequest($request);
			if ($form -> isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($post);
				$em->flush();

				// add a flash message 
				$this->get('session')->getFlashBag()->add('success', 'Your proposition has been saved!');
				
				return $this->redirect($this->generateUrl('blog_propose'));
			}
		}

		return array(
			'form' => $form->createView(),
		);
	}

}