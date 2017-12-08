<?php

namespace Knp\UniMail;

interface MailFactory
{
    /**
     * @param string     $name
     * @param null|array $options
     *
     * @return Mail
     */
    public function createMail($name, array $options = []);
}
