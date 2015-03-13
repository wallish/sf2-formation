<?php

namespace ESGI\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ESGI\BlogBundle\Entity\Post as Post;
use ESGI\BlogBundle\Form\ProposePostType;

//
use ESGI\BlogBundle\Notify\NotifyEvents;
use ESGI\BlogBundle\Event\ProposePostEvent;

class ProposeController extends Controller
{
    /**
     * @Route("/propose", name="esgi_propose")
     */
    public function proposeAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(new ProposePostType(), $post);

        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $user = $this->get('security.context')->getToken()->getUser();
                $em = $this->getDoctrine()->getManager();
                $post->setAuthor($user);
                $post->setIsPublished(false);
                $em->persist($post);
                $em->flush();
                
                $event = new ProposePostEvent($post, $post->getAuthor());

                $this
                  ->get('event_dispatcher')
                  ->dispatch(NotifyEvents::onProposePost, $event)
                ; 
                
//                $message = \Swift_Message::newInstance()
//                    ->setSubject("Un nouvel article a été proposé")
//                    ->setFrom('admin@keninjafa.com')
//                    ->setTo('fanorazafi@gmail.com')
//                    ->setBody("L'utilisateur ".$post->getAuthor()->getUsername()." a proposé un nouvel article : <b>".$post->getTitle()."</b><br />".$post->getBody());
//
//                $this->get('mailer')->send($message);
                
                $this->get('session')->getFlashBag()->add('success', 'Votre proposition a été correctement enregistrée!');
                return $this->redirect($this->generateUrl('esgi_propose')); 

                $this->get('session')->getFlashBag()->add('success', 'Votre proposition a été correctement enregistrée!');

                return $this->redirect($this->generateUrl('esgi_propose'));
            }
        }

        return $this->render('ESGIBlogBundle:Propose:propose.html.twig', array(
                'form' => $form->createView(),
                ));
    }
}
