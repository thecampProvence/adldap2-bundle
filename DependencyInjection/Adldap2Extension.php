<?php

namespace Sgomez\Bundle\Adldap2Bundle\DependencyInjection;

use Adldap\Adldap;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class Adldap2Extension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $connectionSettings = $config['connection_settings'];

        if (!empty($connectionSettings['account_suffix'])) {
            $connectionSettings['account_suffix'] = '@'.$connectionSettings['account_suffix'];
        } else {
            unset($connectionSettings['account_suffix']);
        }

        // $service = $container->register('adldap2', Adldap::class);
        $service = $container->getDefinition('adldap2');
        $service->setFactory([
            Adldap2Factory::class,
            'createConnection'
        ]);
        $service->addArgument($connectionSettings);
        // $service->setArguments([$connectionSettings]);
    }

    public function getAlias()
    {
        return 'adldap2';
    }
}
