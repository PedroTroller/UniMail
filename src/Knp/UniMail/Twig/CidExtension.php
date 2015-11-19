<?php

namespace Knp\UniMail\Twig;

use Doctrine\Common\Collections\ArrayCollection;
use Knp\UniMail\Cid\Collection;
use Knp\UniMail\Cid\Resolver;
use Twig_Extension;
use Twig_SimpleFunction;

class CidExtension extends Twig_Extension
{
    /**
     * @var ArrayCollection
     */
    private $cids;

    /**
     * @var Resolver[]
     */
    private $resolvers;

    /**
     * @param Collection $cids
     * @param Resolver[] $resolvers
     */
    public function __construct(Collection $cids, array $resolvers)
    {
        $this->cids      = $cids;
        $this->resolvers = $resolvers;
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

    /**
     * @param string $path
     *
     * @return string
     */
    public function addCid($path)
    {
        foreach ($this->resolvers as $resolver) {
            if (null !== $attachment = $resolver->createFromString($path)) {
                $attachment->setDisposition('inline');
                $this->cids->add($attachment);

                return sprintf('cid:%s', $attachment->getId());
            }
        }

        throw new \RuntimeException(sprintf('Can\'t resolve cid from "%s".', $path));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'knp_unimail.cids';
    }
}
