<?php

namespace Knp\UniMail\Mailer;

use Knp\UniMail\Mail;
use Knp\UniMail\Mail\SwiftMail;
use Knp\UniMail\Mailer;
use Knp\UniMail\MailFactory;
use Swift_Mailer;
use Swift_Message;

class SwiftMailer implements Mailer
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var MailFactory
     */
    private $factory;

    /**
     * @param MailFactory $factory
     */
    public function __construct(Swift_Mailer $mailer, MailFactory $factory)
    {
        $this->mailer  = $mailer;
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    public function createMail($name, array $options = [])
    {
        return $this
            ->factory
            ->createMail($name, $options)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function sendMail(Mail $mail)
    {
        if (false === $mail instanceof SwiftMail) {
            throw new \RuntimeException(sprintf(
                'Your mail should be a Knp\UniMail\Mail\SwiftMail, %s given',
                get_class($mail)
            ));
        }

        $message = Swift_Message::newInstance()
            ->setSubject($mail->getSubject())
            ->setFrom($mail->getFrom())
            ->setTo($mail->getTo())
            ->setBody($mail->getHtmlBody(), 'text/html')
            ->addPart($mail->getTextBody())
        ;

        foreach ($mail->getAttachments() as $attachment) {
            $message->attach($attachment);
        }

        $this->mailer->send($message);
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
