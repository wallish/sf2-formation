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
use ESGI\BlogBundle\Form\AddCommentType;


class CommentController extends Controller
{

    /**
     * @Template()
     */
	/*public function addAction()
	{
		$em = $this->getDoctrine()->getManager();	
        $post = $em->getRepository('ESGIBlogBundle:Post')->findBy(array("id" => 90));

        
        $comment = new Comment();
        $comment->setText('youlou');
        $comment->setPost($post[0]);
        $comment->setIsPublished(false);
        $em->persist($comment);
        $em->flush();


        return [
        	'post' => $post,
        ];
	}*/

    public function addAction(Request $request)
    {
        $comment = new Comment(); 
        $form = $this->createForm(new AddCommentType(), $comment); 
        
        if($request->getMethod() == Request::METHOD_POST){
            $form->handleRequest($request);
            
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $comment->setIsPublished(false);

                $em->persist($comment);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Votre commentaire a été correctement enregistrée!');

                return $this->redirect($this->generateUrl('comment_add')); 
            }
        }
        
        return $this->render('ESGIBlogBundle:Comment:add.html.twig',array(
                'form' => $form->createView(), 
            ));
        
        
    }

}