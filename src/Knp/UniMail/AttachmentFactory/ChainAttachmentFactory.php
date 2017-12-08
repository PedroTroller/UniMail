<?php

namespace Knp\UniMail\AttachmentFactory;

use Knp\UniMail\AttachmentFactory;

class ChainAttachmentFactory implements AttachmentFactory
{
    /**
     * @var AttachmentFactory[]
     */
    private $factories;

    /**
     * @param AttachmentFactory[] $factories
     */
    public function __construct(array $factories)
    {
        $this->factories = $factories;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($content)
    {
        foreach ($this->factories as $factory) {
            if (true === $factory->supports($content)) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function createAttachment($name, $content)
    {
        foreach ($this->factories as $factory) {
            if (true === $factory->supports($content)) {
                return $factory->createAttachment($name, $content);
            }
        }

        $message = "Can't create attachement from %s %s";

        switch (true) {
            case is_array($content):
                $message = sprintf($message, 'an', 'array');

                break;
            case is_object($content):
                $message = sprintf($message, 'object', get_class($content));

                break;
            default:
                $message = sprintf($message, gettype($content), $content);

                break;
        }

        throw new \Exception($message);
    }
}
