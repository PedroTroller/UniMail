<?php

namespace Knp\UniMail;

use Symfony\Component\EventDispatcher\Event;

class MailerEvent extends Event
{
    /**
     * @var Mail
     */
    private $mail;

    /**
     * @param Mail $mail
     */
    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return Mail
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param Mail $mail
     *
     * @return MailerEvent
     */
    public function setMail(Mail $mail)
    {
        $this->mail = $mail;

        return $this;
    }
}
