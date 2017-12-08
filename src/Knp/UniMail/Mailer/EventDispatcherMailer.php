<?php

namespace Knp\UniMail\Mailer;

use Knp\UniMail\Mail;
use Knp\UniMail\Mailer;
use Knp\UniMail\MailerEvent;
use Knp\UniMail\MailerEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventDispatcherMailer implements Mailer
{
    /**
     * @var Mailer
     */
    private $wrapped;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @param Mailer                   $wrapped
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        Mailer $wrapped,
        EventDispatcherInterface $dispatcher
    ) {
        $this->wrapped    = $wrapped;
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function createMail($name, array $options = [])
    {
        return $this
            ->wrapped
            ->createMail($name, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function sendMail(Mail $mail)
    {
        $event = new MailerEvent($mail);

        $this
            ->dispatcher
            ->dispatch(MailerEvents::PRE_SEND, $event);

        $this
            ->dispatcher
            ->dispatch(MailerEvents::preSend($event->getMail()), $event);

        $this
            ->wrapped
            ->sendMail($event->getMail());

        $this
            ->dispatcher
            ->dispatch(MailerEvents::postSend($event->getMail()), $event);

        $this
            ->dispatcher
            ->dispatch(MailerEvents::POST_SEND, $event);
    }

    /**
     * {@inheritdoc}
     */
    public function send($name, array $options = [])
    {
        $mail = $this->createMail($name, $options);

        $this->sendMail($mail);
    }
}
