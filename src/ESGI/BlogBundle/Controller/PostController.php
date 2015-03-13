<?php

namespace ESGI\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query;
use ESGI\BlogBundle\Entity\Post as Post;
use ESGI\BlogBundle\Entity\Comment as Comment;
use ESGI\BlogBundle\Form\AddCommentType;
use Symfony\Component\HttpFoundation\Response;

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
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('ESGIBlogBundle:Post')->paginator();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->get('page', 1),
            10
        );

        // parameters to template
        return [
            'pagination' => $pagination,
        ];
    }

    /**
     * @Template()
     */
    public function showAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('ESGIBlogBundle:Post')->findBy(array("slug" => $slug));

        $comment = new Comment();
        $form = $this->createForm(new AddCommentType(), $comment);

        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $comment->setIsPublished(false);
                $comment->setPost($post[0]);

                $em->persist($comment);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Votre commentaire a été correctement enregistrée!');

                return $this->redirect($this->generateUrl('post_show', array('slug' => $slug)));
            }
        }

        return [
            'post' => $post,
            'form' => $form->createView(),
            'slug' => $slug,
            'comments' => $post[0]->getComments()->toArray(),
        ];
    }

    /**
     * Generate the article feed
     *
     * @return Response XML Feed
     */
    public function feedAction()
    {
        $articles = $this->getDoctrine()->getRepository('ESGIBlogBundle:Post')->findAll();

        $feed = $this->get('eko_feed.feed.manager')->get('article');
        $feed->addFromArray($articles);

        return new Response($feed->render('rss')); // or 'atom'
    }
}
