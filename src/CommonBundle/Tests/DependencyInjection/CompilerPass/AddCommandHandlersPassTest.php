<?php

namespace RP\CommonBundle\Tests\DependencyInjection\CompilerPass;

use RP\CommonBundle\DependencyInjection\CompilerPass\AddCommandHandlersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class AddCommandHandlersPassTest extends \PHPUnit_Framework_TestCase
{
    public function test_handlers_added_to_bus()
    {
        $container = new ContainerBuilder();
        $container->setDefinition('rp.command_bus', $bus = new Definition('CommandBus'));

        $handler1 = new Definition('\AppBundle\Worksheet\CommandHandler\ReleaseResponseLockCommandHandler');
        $handler1->addTag('command_bus.handler');
        $handler2 = new Definition('\AppBundle\Worksheet\CommandHandler\ReleaseResponseLockCommandHandler');
        $handler2->addTag('command_bus.handler');

        $container->setDefinition('handler_1', $handler1);
        $container->setDefinition('handler_2', $handler2);

        $compiler = new AddCommandHandlersPass();
        $compiler->process($container);

        $calls = $bus->getMethodCalls();
        $this->assertCount(2, $calls);
        $this->assertEquals('addHandler', $calls[0][0]);
        $this->assertEquals('handler_1', $calls[0][1][0]);
        $this->assertEquals('addHandler', $calls[1][0]);
        $this->assertEquals('handler_2', $calls[1][1][0]);
    }

    public function test_known_dependencies_injected_injected_into_handlers()
    {
        $container = new ContainerBuilder();
        $container->setDefinition('rp.command_bus', $bus = new Definition('CommandBus'));

        $handler1 = new Definition('\AppBundle\Company\CommandHandler\CreatePlanItemsCommandHandler');
        $handler1->addTag('command_bus.handler');
        $handler2 = new Definition('\AppBundle\SupportMessage\CommandHandler\PrepareAndSendToAdminCommandHandler');
        $handler2->addTag('command_bus.handler');
        $handler3 = new Definition('\AppBundle\SupportMessage\CommandHandler\SendToUserCommandHandler');
        $handler3->addTag('command_bus.handler');

        $container->setDefinition('handler_1', $handler1);
        $container->setDefinition('handler_2', $handler2);
        $container->setDefinition('handler_3', $handler3);

        $compiler = new AddCommandHandlersPass();
        $compiler->process($container);
        $calls1 = $handler1->getMethodCalls();
        $this->assertCount(1, $calls1);
        $this->assertEquals('setEntityManager', $calls1[0][0]);
        $this->assertEquals('doctrine.orm.default_entity_manager', $calls1[0][1][0]);

        $calls2 = $handler2->getMethodCalls();
        $this->assertCount(1, $calls2);
        $this->assertEquals('setCommandBus', $calls2[0][0]);
        $this->assertEquals('rp.command_bus', $calls2[0][1][0]);

        $calls3 = $handler3->getMethodCalls();
        $this->assertCount(2, $calls3);
        $this->assertEquals('setEntityManager', $calls3[0][0]);
        $this->assertEquals('doctrine.orm.default_entity_manager', $calls3[0][1][0]);
        $this->assertEquals('setEventDispatcher', $calls3[1][0]);
        $this->assertEquals('event_dispatcher', $calls3[1][1][0]);
    }
}
