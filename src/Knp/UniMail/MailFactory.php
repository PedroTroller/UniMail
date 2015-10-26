<?php

namespace Knp\UniMail;

interface MailFactory
{
    /**
     * @param string     $name
     * @param array|null $options
     *
     * @return Mail
     */
    public function createMail($name, array $options = []);
}
