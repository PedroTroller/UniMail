<?php

namespace Knp\UniMail\MailFactory\StrategyMailer;

use Knp\UniMail\MailFactory;
use Knp\UniMail\MailFactory\StrategyMailer;
use Symfony\Component\PropertyAccess\PropertyAccess;

class SwiftMailFactory implements StrategyMailer, MailFactory
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
        $options = $this->computeOptions($options);

        if (false === array_key_exists('subject', $options)) {
            return false;
        }

        foreach (['html_body', 'text_body'] as $content) {
            if (true === array_key_exists($content, $options)) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function createMail($name, array $options = [])
    {
        $options = $this->computeOptions($options);

        $mail = new SwiftMail($name);

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
        if (true === array_key_exists('body', $options)) {
            $options['html_body'] = $options['body'];
            $options['text_body'] = $options['body'];

            unset($options['body']);
        }

        return $options;
    }
}
