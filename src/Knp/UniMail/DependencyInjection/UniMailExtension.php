<?php

namespace Knp\UniMail\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class UniMailExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $configuration = $this->getConfiguration($config, $container);
        $config        = $this->processConfiguration($configuration, $config);

        foreach ($config as $key => $value) {
            $container->setParameter(sprintf('%s.%s', $this->getAlias(), $key), $value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration(array $config, ContainerBuilder $container)
    {
        return  new Configuration(sprintf('%s/../web', $container->getParameter('kernel.root_dir')));
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'knp_unimail';
    }
}
