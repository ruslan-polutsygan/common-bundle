<?php

namespace RP\CommonBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class RPCommonExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $builder = $container->getDefinition('rp.menu_builder');
        if(isset($config['menu'])) {
            foreach($config['menu'] as $name => $items) {
                $menu = new Definition('Knp\Menu\MenuItem');
                $menu->setFactory([$builder, 'createMenu']);
                $menu->setArguments([$items]);
                $menu->addTag('knp_menu.menu', ['alias' => $name]);

                $container->setDefinition('rp_common.menu.'.$name, $menu);
            }
        }
    }
}
