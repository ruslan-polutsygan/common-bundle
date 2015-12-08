<?php

namespace RP\CommonBundle\CommandBus\CommandHandler;

use RP\CommonBundle\CommandBus\Command\CommandInterface;

interface CommandHandlerInterface
{
    /**
     * @param CommandInterface $command
     *
     * @return bool
     */
    public function supports(CommandInterface $command);

    /**
     * @param CommandInterface $command
     *
     * @return mixed
     */
    public function handle(CommandInterface $command);
}
