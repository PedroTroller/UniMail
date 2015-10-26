<?php

namespace Knp\UniMail\MailFactory;

use Knp\UniMail\MailFactory;

class RegistryFactory implements MailFactory
{
    /**
     * @var StrategyMailer[]
     */
    private $strategies;

    /**
     * @param StrategyMailer[] $strategies
     */
    public function __construct(array $strategies)
    {
        $this->strategies = $strategies;
    }

    /**
     * {@inheritdoc}
     */
    public function createMail($name, array $options = [])
    {
        foreach ($this->strategies as $strategy) {
            if (true === $strategy->supports($options)) {
                return $strategy->createMail($name, $options);
            }
        }

        throw new \RuntimeException(sprintf(
            'Impossible to create a mail from the given parameters : "%s"',
            implode('", "', array_keys($options))
        ));
    }
}
