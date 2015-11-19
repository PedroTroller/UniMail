<?php

namespace Knp\UniMail\Cid;

use Swift_Mime_Attachment;

class Collection implements \IteratorAggregate
{
    /**
     * @var Swift_Mime_Attachment[]
     */
    private $cids;

    /**
     * @param Swift_Mime_Attachment[] $cids
     */
    public function __construct($cids = [])
    {
        $this->cids = $cids;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->cids);
    }

    /**
     * @return Swift_Mime_Attachment[]
     */
    public function all()
    {
        return $this->cids;
    }

    /**
     * @param Swift_Mime_Attachment $cid
     *
     * @return Collection
     */
    public function add(Swift_Mime_Attachment $cid)
    {
        $this->cids[$cid->getId()] = $cid;

        return $this;
    }

    /**
     * @return Collection
     */
    public function clear()
    {
        $this->cids = [];

        return $this;
    }
}
