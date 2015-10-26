<?php

namespace Knp\UniMail;

interface AttachmentFactory
{
    /**
     * @param mixed $content
     *
     * @return bool
     */
    public function supports($content);

    /**
     * @param string $name
     * @param mixed  $content
     *
     * @return Swift_Attachment
     */
    public function createAttachment($name, $content);
}
