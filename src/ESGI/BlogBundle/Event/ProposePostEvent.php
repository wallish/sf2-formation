<?php
// src/OC/PlatformBundle/Bigbrother/MessagePostEvent.php

namespace ESGI\BlogBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use ESGI\BlogBundle\Entity\Post;
use ESGI\UserBundle\Entity\User;

class ProposePostEvent extends Event
{
    protected $post;
    protected $user;

    public function __construct(Post $post, User $user)
    {
        $this->post    = $post;
        $this->user    = $user;
    }

    // Le listener doit avoir accès au message
    public function getPost()
    {
        return $this->post;
    }

    // Le listener doit avoir accès à l'utilisateur
    public function getUser()
    {
        return $this->user;
    }
}