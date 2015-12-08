<?php

namespace RP\CommonBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class AddCommandHandlersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $tagged = $container->findTaggedServiceIds('command_bus.handler');
        $bus = $container->getDefinition('app.command_bus');

        foreach ($tagged as $id => $tag) {
            $bus->addMethodCall('addHandler', [new Reference($id)]);

            $definition = $container->getDefinition($id);
            $this->injectKnownDependencies($definition);
        }
    }

    protected function injectKnownDependencies(Definition $definition)
    {
        $class = $definition->getClass();
        $r = new \ReflectionClass($class);

        if ($r->implementsInterface('RP\CommonBundle\CommandBus\CommandHandler\EntityManagerAwareInterface')) {
            $definition->addMethodCall('setEntityManager', [new Reference('doctrine.orm.default_entity_manager')]);
        }

        if ($r->implementsInterface('RP\CommonBundle\CommandBus\CommandHandler\CommandBusAwareInterface')) {
            $definition->addMethodCall('setCommandBus', [new Reference('app.command_bus')]);
        }

        if ($r->implementsInterface('RP\CommonBundle\CommandBus\CommandHandler\EventDispatcherAwareInterface')) {
            $definition->addMethodCall('setEventDispatcher', [new Reference('event_dispatcher')]);
        }
    }
}
