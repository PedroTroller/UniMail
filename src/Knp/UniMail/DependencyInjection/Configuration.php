<?php

namespace Knp\UniMail\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @var array
     */
    private $defaults;

    /**
     * @param array $defaults
     *
     * @return
     */
    public function __construct(array $defaults)
    {
        $this->defaults = $defaults;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $builder
            ->root('knp_unimail')
            ->children()
                ->scalarNode('attachments_directory')->defaultValue($this->defaults['attachments_directory'])->end()
                ->arrayNode('mails')
                    ->isRequired()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                    ->children()
                        ->scalarNode('from')->defaultNull()->end()
                        ->scalarNode('to')->defaultNull()->end()
                        ->arrayNode('attachments')
                            ->prototype('scalar')
                            ->end()
                        ->end()
                        ->scalarNode('subject')->end()
                        ->scalarNode('content')->end()
                        ->scalarNode('html_body')->end()
                        ->scalarNode('text_body')->end()
                        ->scalarNode('template')->end()
                        ->arrayNode('parameters')
                            ->prototype('scalar')
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $builder;
    }
}
