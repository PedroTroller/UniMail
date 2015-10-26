<?php

namespace Knp\UniMail\Twig;

use Doctrine\Common\Collections\ArrayCollection;
use Swift_EmbeddedFile;
use Twig_Extension;
use Twig_SimpleFunction;

class CidExtension extends Twig_Extension
{
    /**
     * @var ArrayCollection
     */
    private $cids;

    /**
     * @var string
     */
    private $directory;

    /**
     * @param ArrayCollection $cids
     * @param string          $directory
     */
    public function __construct(ArrayCollection $cids, $directory)
    {
        $this->cids      = $cids;
        $this->directory = $directory;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('cid', [$this, 'addCid']),
        ];
    }

    public function addCid($path)
    {
        $path = str_replace('/', DIRECTORY_SEPARATOR, $path);

        $attachment = Swift_EmbeddedFile::fromPath(sprintf('%s%s%s', $this->directory, DIRECTORY_SEPARATOR, $path));
        $attachment->setDisposition('inline');

        $parts                   = explode(DIRECTORY_SEPARATOR, $path);
        $this->cids[end($parts)] = $attachment;

        return sprintf('cid:%s', $attachment->getId());
    }

    public function getName()
    {
        return 'knp_unimail.cids';
    }
}
