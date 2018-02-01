<?php

namespace Kami\ApiCoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kami_api_core');
        $rootNode->children()
            ->arrayNode('resources')->isRequired()
                ->arrayPrototype()
                    ->children()
                        ->scalarNode('name')->isRequired()->end()
                        ->scalarNode('entity')->isRequired()->end()
                    ->end()
                ->end()
            ->end()
            ->arrayNode('locales')->isRequired()
                ->scalarPrototype()->isRequired()->end()
            ->end()
            ->arrayNode('pagination')->addDefaultsIfNotSet()
                ->children()
                    ->integerNode('per_page')
                        ->isRequired()
                        ->defaultValue(10)
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
