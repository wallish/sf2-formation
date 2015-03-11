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
     * @Route("/propose", name="esgi_propose")
     */
    public function proposeAction(Request $request)
    {
        $post = new Post(); 
        $form = $this->createForm(new ProposePostType(), $post); 
        
        if($request->getMethod() == Request::METHOD_POST){
            
            $form->handleRequest($request);
            
            if ($form->isValid()) {
                // save the proposition
                $em = $this->getDoctrine()->getManager();
                $post->setIsPublished(false);
                $em->persist($post);
                $em->flush();
                            // add a flash message
                $this->get('session')->getFlashBag()->add('success', 'Votre proposition a été correctement enregistrée!');
                return $this->redirect($this->generateUrl('esgi_propose')); 

            }
        }
        
        return $this->render('ESGIBlogBundle:Propose:propose.html.twig',array(
                'form' => $form->createView(), 
                ));
        
        
    }   

}