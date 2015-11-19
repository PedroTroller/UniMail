<?php

namespace Knp\UniMail\EventListener;

use Knp\UniMail\AttachmentFactory;
use Knp\UniMail\MailerEvent;
use Knp\UniMail\MailerEvents;
use Swift_Mime_MimeEntity;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AttachmentResolver implements EventSubscriberInterface
{
    public function __construct(AttachmentFactory $factory)
    {
        $this->factory = $factory;
    }

    public static function getSubscribedEvents()
    {
        return [
            MailerEvents::PRE_SEND => array('beforeSend', -2),
        ];
    }

    public function beforeSend(MailerEvent $event)
    {
        $mail        = $event->getMail();
        $attachments = $mail->getAttachments();

        foreach ($attachments as $index => $attachment) {
            if ($attachment instanceof Swift_Mime_MimeEntity) {
                continue;
            }

            $attachments[$index] = $this->factory->createAttachment($index, $attachment);
        }

        $mail->setAttachments($attachments);
    }
}
