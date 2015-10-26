<?php

namespace Knp\UniMail\Mail;

use Knp\UniMail\Mail;

abstract class AbstractMail implements Mail
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $from;

    /**
     * @var string|array<string>
     */
    private $to;

    /**
     * @var array
     */
    private $attachments = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    public function getAttachments()
    {
        return $this->attachments;
    }

    public function setAttachments(array $attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }
}
