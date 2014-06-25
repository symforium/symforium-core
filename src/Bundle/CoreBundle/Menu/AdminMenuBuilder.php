<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Bundle\CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symforium\Core\MenuInterface;
use Knp\Menu\ItemInterface;
use Symforium\Core\Plugin;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class AdminMenuBuilder extends ContainerAware
{
    /**
     * @var array|Plugin[] $plugins
     */
    private $plugins = array();

    /**
     * @var FactoryInterface $factory
     */
    private $factory;

    /**
     * @param array $plugins
     * @param FactoryInterface $factory
     */
    public function __construct(array $plugins, FactoryInterface $factory)
    {
        $this->plugins = $plugins;
        $this->factory = $factory;
    }

    /**
     * @param Request $request
     *
     * @throws \Exception
     * @return ItemInterface
     */
    public function createMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setCurrentUri($request->getRequestUri());
        $menu->setChildrenAttribute('class', 'nav nav-pills nav-stacked');

        $menu->addChild('Dashboard', ['route' => 'symforium_core_admin_index'])
            ->setAttribute('icon', 'dashboard');

        $this->addSettingsMenu($menu);

        $pluginMenu = $menu->addChild('Plugins', ['uri' => '#'])
            //->setAttribute('dropdown', true)
            ->setAttribute('icon', 'globe');



        foreach ($this->plugins as $plugin) {
            $class = $plugin::getMenuClass();
            if ($class === false) {
                continue;
            }

            $pluginMenuClass = new $class;
            if (!($pluginMenuClass instanceof MenuInterface)) {
                throw new \Exception("Menu for $plugin does not implement Symforium\\Core\\MenuInterface");
            }

            $pluginMenuClass->build($request, $pluginMenu);
        }

        return $menu;
    }

    private function addSettingsMenu(ItemInterface $menu)
    {
        $settings = $menu->addChild('Settings', ['uri' => '#'])
            ->setAttribute('icon', 'gears');

        $settings->addChild('Application', ['route' => 'symforium_core_settings_application'])
            ->setAttribute('icon', 'sliders');

        $settings->addChild('Database', ['route' => 'symforium_core_settings_database'])
            ->setAttribute('icon', 'database');

        $settings->addChild('Menu', ['route' => 'symforium_core_settings_menu'])
            ->setAttribute('icon', 'bars');
    }
}
 