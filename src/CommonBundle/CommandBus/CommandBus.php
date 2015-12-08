<?php

namespace RP\CommonBundle\CommandBus;

use RP\CommonBundle\CommandBus\Command\CommandInterface;
use RP\CommonBundle\CommandBus\CommandHandler\CommandHandlerInterface;

class CommandBus
{
    /**
     * @var CommandHandlerInterface[]
     */
    protected $handlers = [];

    /**
     * @param CommandHandlerInterface $handler
     */
    public function addHandler(CommandHandlerInterface $handler)
    {
        $this->handlers[] = $handler;
    }

    public function handle(CommandInterface $command)
    {
        foreach ($this->handlers as $handler) {
            if ($handler->supports($command)) {
                return $handler->handle($command);
            }
        }

        throw new \RuntimeException(sprintf('Could not find handler for "%s" command', get_class($command)));
    }
}
