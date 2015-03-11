<?php

namespace ESGI\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use ESGI\BlogBundle\Entity\Post as Post;
//use ESGI\BlogBundle\Entity\PostRepository;

class DefaultController extends Controller
{
    /**
     * @Route("/city/{name}/{city}")
     */
    public function cityAction($name, $city)
    {
        return new Response(sprintf(
        	'Salut %s, on est à %s', $name, $city
    	));
    }

    /**
     * @Route("/toto")
     */
    public function totoAction(Request $request)
    {
    	//die(var_dump($request));
        return new Response(sprintf(
        	'Salut %s, on est à %s', $name, $city
    	));
    }

    /**
     * @Route("/addition/{a}/{b}")
     * @Template()
     */
    public function additionAction($a, $b)
    {
        return [
            'sum' => $this->get('esgi.computer')->addition($a,$b),
            'power' => $this->get('esgi.computer')->power($a)
        ];
    }

    /**
     * @Route("/new-post")
     */
    public function newPostAction()
    {
        $post = new Post();
        $post->setTitle('Titre du post');
        $post->setBody('Corps du post');
        $post->setIsPublished(1);
        $this->get('doctrine.orm.entity_manager')->persist($post);
        $this->get('doctrine.orm.entity_manager')->flush();

        return new Response('post créé : id ' . $post->getId());
    }

    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $publishedPosts = $em->getRepository('ESGIBlogBundle:Post')->findPublished();
        $posts = $em->getRepository('ESGIBlogBundle:Post')->findAll();
//        var_dump($publishedPosts);
       
        return $this->render("ESGIBlogBundle:Default:index.html.twig", array("posts"=>$posts));
    }
}
