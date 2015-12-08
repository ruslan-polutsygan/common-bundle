<?php

namespace RP\CommonBundle\CommandBus\CommandHandler;

use RP\CommonBundle\CommandBus\CommandBus;

trait CommandBusAwareTrait
{
    /**
     * @var CommandBus
     */
    protected $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function setCommandBus(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }
}
