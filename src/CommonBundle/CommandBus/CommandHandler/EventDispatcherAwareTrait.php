<?php

namespace RP\CommonBundle\CommandBus\CommandHandler;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

trait EventDispatcherAwareTrait
{
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function setEventDispatcher($dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }
}
