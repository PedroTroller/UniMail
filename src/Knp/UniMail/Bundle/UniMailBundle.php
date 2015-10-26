<?php

namespace Knp\UniMail\Bundle;

use Knp\UniMail\DependencyInjection\UniMailExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UniMailBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new UniMailExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        return dirname(parent::getPath());
    }
}
