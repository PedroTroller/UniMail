<?php

namespace Knp\UniMail\Mailer;

use Doctrine\Common\Collections\ArrayCollection;
use Knp\UniMail\Mail;
use Knp\UniMail\Mailer as MailerInterface;
use Knp\UniMail\MailFactory;
use Swift_Mailer;
use Swift_Message;
use Twig_Environment;

class TwigMailer implements MailerInterface
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var MailFactory
     */
    private $factory;

    /**
     * @var ArrayCollection
     */
    private $cids;

    /**
     * @param MailFactory $factory
     */
    public function __construct(Twig_Environment $twig, Swift_Mailer $mailer, MailFactory $factory,  ArrayCollection $cids)
    {
        $this->twig    = $twig;
        $this->mailer  = $mailer;
        $this->factory = $factory;
        $this->cids    = $cids;
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
        $message  = Swift_Message::newInstance();
        $template = $this->twig->loadTemplate($mail->getTemplate());
        $subject  = $template->renderBlock('subject',   $mail->getParameters());
        $html     = $template->renderBlock('html_body', $mail->getParameters());
        $text     = $template->renderBlock('text_body', $mail->getParameters());

        $message
            ->setSubject($subject)
            ->setFrom($mail->getFrom())
            ->setTo($mail->getTo())
            ->setBody($html, 'text/html')
            ->addPart($text)
        ;

        foreach ($this->cids as $name => $attachment) {
            $message->attach($attachment);
        }

        $this->cids->clear();

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
