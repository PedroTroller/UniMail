<?php

namespace Knp\UniMail\MailFactory\StrategyMailer;

use Knp\UniMail\MailFactory;
use Knp\UniMail\MailFactory\StrategyMailer;
use Knp\UniMail\Mail\TwigMail;
use Symfony\Component\PropertyAccess\PropertyAccess;

class TwigMailFactory implements StrategyMailer, MailFactory
{
    /**
     * @var PropertyAccessor
     */
    private $accessor;

    public function __construct()
    {
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    /**
     * {@inheritdoc}
     */
    public function supports(array $options)
    {
        if (false === array_key_exists('template', $options)) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function createMail($name, array $options = [])
    {
        $options = $this->computeOptions($options);

        $mail = new TwigMail($name);

        foreach ($options as $index => $value) {
            $this->accessor->setValue($mail, $index, $value);
        }

        return $mail;
    }

    /**
     * @param array $options
     *
     * @return array
     */
    private function computeOptions(array $options = [])
    {
        if (false === array_key_exists('parameters', $options)) {
            $options['parameters'] = [];
        }

        return $options;
    }
}
