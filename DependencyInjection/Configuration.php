<?php

namespace Sgomez\Bundle\Adldap2Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('adldap2');

        $rootNode
            ->children()
                ->arrayNode('connection_settings')
                    ->children()
                        ->arrayNode('hosts')
                            ->prototype('scalar')->end()
                            ->isRequired()
                            ->requiresAtLeastOneElement()
                        ->end()
                        ->integerNode('port')
                        ->end()
                        ->scalarNode('account_suffix')
                        ->end()
                        ->scalarNode('base_dn')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('username')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('password')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('schema')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->booleanNode('follow_referrals')
                            ->defaultFalse()
                        ->end()
                        ->booleanNode('use_ssl')
                            ->defaultFalse()
                        ->end()
                        ->booleanNode('use_tls')
                            ->defaultFalse()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

