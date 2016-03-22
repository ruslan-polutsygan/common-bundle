<?php

namespace RP\CommonBundle\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    /**
     * @var FactoryInterface
     */
    protected $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMenu(array $items = [], $options = [])
    {
        $menu = $this->factory->createItem('root')
            ->setChildrenAttributes(['class' => isset($options['class']) ? $options['class'] : 'nav navbar-nav'])
        ;

        foreach ($items as $key => $menuItemConfig) {
            $menu->addChild('main-menu-item-'.$key, [
                'route' => $menuItemConfig['route'],
                'routeParameters' => isset($menuItemConfig['route_parameters']) ? $menuItemConfig['route_parameters'] : [],
                'label' => $menuItemConfig['label'],
            ]);
        }

        return $menu;
    }
}
