<?php

namespace Knp\UniMail\Cid;

interface Resolver
{
    /**
     * @param string $string
     *
     * @return Swift_EmbeddedFile|null
     */
    public function createFromString($string);
}
