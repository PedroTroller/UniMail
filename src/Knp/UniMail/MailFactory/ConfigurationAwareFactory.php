<?php

namespace Knp\UniMail\MailFactory;

use Knp\UniMail\MailFactory;

class ConfigurationAwareFactory implements MailFactory
{
    /**
     * @var array
     */
    private $configuration;

    /**
     * @var MailFactory
     */
    private $wrapped;

    /**
     * @param array $configuration
     */
    public function __construct(array $configuration, MailFactory $wrapped)
    {
        $this->configuration = $configuration;
        $this->wrapped       = $wrapped;
    }

    /**
     * {@inheritdoc}
     */
    public function createMail($name, array $options = [])
    {
        if (true === array_key_exists($name, $this->configuration)) {
            $options = array_replace(
                $this->configuration[$name],
                $options
            );
        }

        return $this->wrapped->createMail($name, $options);
    }
}
