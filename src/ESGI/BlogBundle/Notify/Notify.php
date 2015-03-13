<?php
// src/OC/PlatformBundle/Bigbrother/CensorshipProcessor.php

namespace ESGI\BlogBundle\Notify;

use Symfony\Component\Security\Core\User\UserInterface;

class Notify    
{
  protected $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    // Méthode pour notifier de la proposition d'un article
    public function sendEmail($post, $user)
    {
        $message = \Swift_Message::newInstance()
                    ->setSubject("Un nouvel article a été proposé")
                    ->setFrom('admin@keninjafa.com')
                    ->setTo('fanorazafi@gmail.com')
                    ->setBody("L'utilisateur ".$user->getUsername()." a proposé un nouvel article : <b>".$post->getTitle()."</b><br />".$post->getBody());
        
        $this->mailer->send($message);
    }
}