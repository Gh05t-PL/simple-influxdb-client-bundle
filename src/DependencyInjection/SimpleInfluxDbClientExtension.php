<?php

namespace Gh05tPL\SimpleInfluxDbClientBundle\DependencyInjection;

use InfluxDB2\Client;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class SimpleInfluxDbClientExtension extends \Symfony\Component\HttpKernel\DependencyInjection\Extension
{
    public function getAlias(): string
    {
        return 'gh05tpl_influxdb_client';
    }

    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('factory.yaml');
        $loader->load('registry.yaml');

        $this->buildClients($container, $config);
    }

    private function createClient(ContainerBuilder $container, string $clientName, array $config): void
    {
        $clientDefinition = new Definition(Client::class, [
            $config['host'] . ':' . $config['port'],
            $config['token'],
            $config['organization'],
            $config['bucket'],
            $config['precision'],
            $config['timeout'],
        ]);

        $clientDefinition->setFactory([new Reference('gh05tpl_influxdb_client.client_factory'), 'createClient']);
        $clientDefinition->setPublic(true);
        $clientDefinition->setLazy(true);

        $serviceId = sprintf('gh05tpl_influxdb_client.client_%s', $clientName);
        $container->setDefinition($serviceId, $clientDefinition);
        $container->registerAliasForArgument(
            $serviceId,
            Client::class,
            $this->strToCamelCase($clientName)
        );

        $container
            ->getDefinition('gh05tpl_influxdb_client.client_registry')
            ->addMethodCall('addClient', [
                $clientName,
                new Reference($serviceId)
            ]);
    }

    private function buildClients(ContainerBuilder $container, array $config): void
    {
        foreach ($config['clients'] as $clientName => $clientConfig) {
            $this->createClient($container, $clientName, $clientConfig);
        }
    }

    private function strToCamelCase(string $string): string
    {
        return lcfirst(str_replace(
            ' ',
            '',
            ucwords(str_replace(
                ['-', '.', '_'],
                ' ',
                $string
            ))
        ));
    }
}