<?php

namespace RP\CommonBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $builder->root('rp_common')
            ->children()
                ->variableNode('menu')
                ->end()
            ->end()
        ;


        return $builder;
    }
}
