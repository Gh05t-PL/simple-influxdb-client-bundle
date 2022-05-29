<?php

namespace Gh05tPL\SimpleInfluxDbClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements \Symfony\Component\Config\Definition\ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('gh05tpl_influxdb_client');
        $rootNode    = $treeBuilder->getRootNode();

        $this->addConnectionsSection($rootNode);

        return $treeBuilder;
    }

    private function addConnectionsSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('clients')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('host')
                                ->isRequired()
                                ->info('Your InfluxDB host address')
                            ->end()
                            ->scalarNode('port')
                                ->isRequired()
                                ->info('Your InfluxDB port')
                            ->end()
                            ->scalarNode('token')
                                ->isRequired()
                                ->info('Your access token for InfluxDB')
                            ->end()
                            ->scalarNode('organization')
                                ->isRequired()
                                ->info('Organization in InfluxDB')
                            ->end()
                            ->scalarNode('bucket')
                                ->isRequired()
                                ->info('Your data bucket in InfluxDB')
                            ->end()
                            ->scalarNode('precision')
                                ->treatNullLike('s')
                                ->defaultValue('s')
                                ->info('Your data bucket in InfluxDB. default = \'s\'')
                            ->end()
                            ->floatNode('timeout')
                                ->defaultValue(0.0)
                                ->info('Setup timeout (seconds) for your requests')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}