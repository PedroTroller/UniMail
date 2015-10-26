<?php

namespace Knp\UniMail\EventListener;

use Knp\UniMail\Mail\SwiftMail;
use Knp\UniMail\Mail\TwigMail;
use Knp\UniMail\MailerEvent;
use Knp\UniMail\MailerEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig_Environment;

class TwigRenderer implements EventSubscriberInterface
{
    private $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public static function getSubscribedEvents()
    {
        return [
            MailerEvents::PRE_SEND => array('beforeSend', -2)
        ];
    }

    public function beforeSend(MailerEvent $event)
    {
        $mail = $event->getMail();

        if (false === $mail instanceof TwigMail) {
            return;
        }

        $clone = SwiftMail::createFromMail($mail);

        $template = $this->twig->loadTemplate($mail->getTemplate());

        $clone->setSubject($template->renderBlock('subject', $mail->getParameters()));
        $clone->setHtmlBody($template->renderBlock('html_body', $mail->getParameters()));
        $clone->setTextBody($template->renderBlock('text_body', $mail->getParameters()));

        $event->setMail($clone);
    }
}
