<?php

namespace Knp\UniMail\EventListener;

use Knp\UniMail\Cid\Collection;
use Knp\UniMail\MailerEvent;
use Knp\UniMail\MailerEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CidAttachmentMerger implements EventSubscriberInterface
{
    private $cids;

    public function __construct(Collection $cids)
    {
        $this->cids = $cids;
    }

    public static function getSubscribedEvents()
    {
        return [
            MailerEvents::PRE_SEND => array('beforeSend', -3),
        ];
    }

    public function beforeSend(MailerEvent $event)
    {
        $mail        = $event->getMail();
        $attachments = $mail->getAttachments();
        $attachments = array_merge(
            $this->cids->all(),
            $attachments
        );

        $this->cids->clear();

        $mail->setAttachments($attachments);
    }
}
