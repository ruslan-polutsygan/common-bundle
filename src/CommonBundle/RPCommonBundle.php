<?php

namespace RP\CommonBundle;

use RP\CommonBundle\DependencyInjection\CompilerPass\AddCommandHandlersPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RPCommonBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddCommandHandlersPass());
    }
}
