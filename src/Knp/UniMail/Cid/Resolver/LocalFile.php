<?php

namespace Knp\UniMail\Cid\Resolver;

use Knp\UniMail\Cid\Resolver;
use Swift_EmbeddedFile;

class LocalFile implements Resolver
{
    /**
     * @var string
     */
    private $directory;

    /**
     * @param string $directory
     */
    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    /**
     * {@inheritdoc}
     */
    public function createFromString($string)
    {
        $string = str_replace('/', DIRECTORY_SEPARATOR, $string);

        if (false === file_exists($string)) {
            return;
        }

        return Swift_EmbeddedFile::fromPath(sprintf('%s%s%s', $this->directory, DIRECTORY_SEPARATOR, $string));
    }
}
