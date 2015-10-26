<?php

namespace Knp\UniMail\EventListener;

use Doctrine\Common\Collections\ArrayCollection;
use Knp\UniMail\MailerEvent;
use Knp\UniMail\MailerEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CidAttachmentMerger implements EventSubscriberInterface
{
    private $cids;

    public function __construct(ArrayCollection $cids)
    {
        $this->cids = $cids;
    }

    public static function getSubscribedEvents()
    {
        return [
            MailerEvents::PRE_SEND => array('beforeSend', -3)
        ];
    }

    public function beforeSend(MailerEvent $event)
    {
        $mail        = $event->getMail();
        $attachments = $mail->getAttachments();
        $attachments = array_merge(
            $this->cids->toArray(),
            $attachments
        );

        $this->cids->clear();

        $mail->setAttachments($attachments);
    }
}
