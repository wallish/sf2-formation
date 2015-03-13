<?php
// src/OC/PlatformBundle/Bigbrother/CensorshipListener.php

namespace ESGI\BlogBundle\Notify;

class NotifyListener
{
    protected $processor;

    public function __construct(Notify $processor)
    {
      $this->processor = $processor;
    }

    public function processNotify(\ESGI\BlogBundle\Event\ProposePostEvent $event)
    {
        $this->processor->sendEmail($event->getPost(), $event->getUser());
    }
}