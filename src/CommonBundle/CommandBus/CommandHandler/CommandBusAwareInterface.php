<?php

namespace RP\CommonBundle\CommandBus\CommandHandler;

use RP\CommonBundle\CommandBus\CommandBus;

interface CommandBusAwareInterface
{
    public function setCommandBus(CommandBus $commandBus);
}
