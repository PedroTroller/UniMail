<?php

namespace Knp\UniMail;

interface Mailer
{
    /**
     * @param string     $name
     * @param array|null $options
     *
     * @return Mail|null
     */
    public function createMail($name, array $options = []);

    /**
     * @param Mail $mail
     */
    public function sendMail(Mail $mail);

    /**
     * @param string $name
     * @param array  $options
     */
    public function send($name, array $options = []);
}
