<?php

namespace RP\CommonBundle\CommandBus\CommandHandler;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface EventDispatcherAwareInterface
{
    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function setEventDispatcher($dispatcher);
}
