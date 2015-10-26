<?php

namespace Knp\UniMail\Mail;

use Knp\UniMail\Mail;

class SwiftMail extends AbstractMail
{
    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $htmlBody;

    /**
     * @var string
     */
    private $textBody;

    public static function createFromMail(Mail $mail)
    {
        return (new self($mail->getName()))
            ->setFrom($mail->getFrom())
            ->setTo($mail->getTo())
            ->setAttachments($mail->getAttachments())
        ;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return string
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getHtmlBody()
    {
        return $this->htmlBody;
    }

    /**
     * @param string $htmlBody
     *
     * @return string
     */
    public function setHtmlBody($htmlBody)
    {
        $this->htmlBody = $htmlBody;

        return $this;
    }

    /**
     * @return string
     */
    public function getTextBody()
    {
        return $this->textBody;
    }

    /**
     * @param string $textBody
     *
     * @return string
     */
    public function setTextBody($textBody)
    {
        $this->textBody = $textBody;

        return $this;
    }
}
