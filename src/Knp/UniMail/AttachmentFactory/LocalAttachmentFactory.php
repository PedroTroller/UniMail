<?php

namespace Knp\UniMail\AttachmentFactory;

use Knp\UniMail\AttachmentFactory;
use Swift_Attachment;

class LocalAttachmentFactory implements AttachmentFactory
{
    /**
     * {@inheritdoc}
     */
    public function supports($content)
    {
        if (false === is_string($content)) {
            return false;
        }

        return true === file_exists($content);
    }

    /**
     * {@inheritdoc}
     */
    public function createAttachment($name, $content)
    {
        $attachment = Swift_Attachment::fromPath($content);

        if (true === is_string($name)) {
            $attachment->setFilename($name);
        }

        return $attachment;
    }
}
