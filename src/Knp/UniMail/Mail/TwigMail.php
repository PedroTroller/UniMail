<?php

namespace Knp\UniMail\Mail;

use Knp\UniMail\Mail;

class TwigMail extends AbstractMail
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var array
     */
    private $parameters;

    public static function createFromMail(Mail $mail)
    {
        return (new self($mail->getName()))
            ->setFrom($mail->getFrom())
            ->setTo($mail->getTo())
            ->setAttachments($mail->getAttachments());
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $string
     * @param mixed  $template
     *
     * @return TwigMail
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     *
     * @return TwigMail
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }
}
