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
use ESGI\BlogBundle\Entity\Comment as Comment;
use ESGI\BlogBundle\Form\ProposePostType;
use ESGI\BlogBundle\Form\AddPostType;
use ESGI\BlogBundle\Form\AddCommentType;


class PostController extends Controller
{

    /**
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('ESGIBlogBundle:Post')->findAll();
        $faker = \Faker\Factory::create();
        echo $faker->city;
        echo $faker->city;
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
	    	'pagination' => $pagination,
	    ];
	}

    /**
     * @Template()
     */
	public function showAction(Request $request,$id)
	{
        
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('ESGIBlogBundle:Post')->findBy(array("id" => $id));
        
        $comment = new Comment(); 
        $form = $this->createForm(new AddCommentType(), $comment); 
        
        if($request->getMethod() == Request::METHOD_POST){
            $form->handleRequest($request);
            
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $comment->setIsPublished(false);
                $comment->setPost($post[0]);

                $em->persist($comment);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Votre commentaire a été correctement enregistrée!');

                return $this->redirect($this->generateUrl('post_show',array('id' => $id))); 
            }
        }

        return [
        	'post' => $post,
            'form' => $form->createView(),
            'id' => $id,
            'comments' => $post[0]->getComments()->toArray()
        ];
    }

    // only admin can do this
    public function deleteAction(Request $request)
    {
    	if($request->getMethod() == Request::METHOD_POST){

            $em = $this->getDoctrine()->getManager();
            $article = $em->getRepository('ESGIBlogBundle:Post')->findBy(array('id' => $id));
            $em->remove($article[0]);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Votre article a été correctement supprimé!');

            return $this->redirect($this->generateUrl('esgi_propose')); 
    	}

        return $this->render('ESGIBlogBundle:Post:delete.html.twig');
    }

    public function addAction(Request $request)
    {
        $post = new Post(); 
        $form = $this->createForm(new AddPostType(), $post); 
        
        if($request->getMethod() == Request::METHOD_POST){
            $form->handleRequest($request);
            
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Votre proposition a été correctement enregistrée!');

                return $this->redirect($this->generateUrl('post_add')); 
            }
        }
        
        return $this->render('ESGIBlogBundle:Post:add.html.twig',array(
                'form' => $form->createView(), 
            ));
        
        
    }

}
