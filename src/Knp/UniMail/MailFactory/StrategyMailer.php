<?php

namespace Knp\UniMail\MailFactory;

interface StrategyMailer
{
    /**
     * @param array $config
     *
     * @return bool
     */
    public function supports(array $config);
}
