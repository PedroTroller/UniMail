<?php

namespace Knp\UniMail\AttachmentFactory;

use Knp\UniMail\AttachmentFactory;
use Swift_Attachment;

class RemoteAttachmentFactory implements AttachmentFactory
{
    /**
     * {@inheritdoc}
     */
    public function supports($content)
    {
        if (false === is_string($content)) {
            return false;
        }

        $headers = @get_headers($content);

        if (false === $headers) {
            return false;
        }

        return false === mb_strpos($headers[0], '404');
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
