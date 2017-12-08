<?php

namespace Knp\UniMail\Cid;

interface Resolver
{
    /**
     * @param string $string
     *
     * @return null|Swift_EmbeddedFile
     */
    public function createFromString($string);
}
