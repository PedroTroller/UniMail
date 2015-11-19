<?php

namespace Knp\UniMail\Cid\Resolver;

use Knp\UniMail\Cid\Resolver;
use Swift_EmbeddedFile;

class RemoteFile implements Resolver
{
    /**
     * {@inheritdoc}
     */
    public function createFromString($string)
    {
        $headers = @get_headers($string);

        if (false === $headers) {
            return;
        }

        if (false !== strpos($headers[0], '404')) {
            return;
        }

        return Swift_EmbeddedFile::fromPath($string);
    }
}
