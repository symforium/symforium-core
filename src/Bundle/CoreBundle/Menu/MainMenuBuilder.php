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
use Doctrine\Bundle\DoctrineBundle\Registry;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class MainMenuBuilder extends ContainerAware
{
    /**
     * @var Registry $doctrine
     */
    private $doctrine;

    /**
     * @var FactoryInterface $factory
     */
    private $factory;

    /**
     * @param Registry         $doctrine
     * @param FactoryInterface $factory
     */
    public function __construct(Registry $doctrine, FactoryInterface $factory)
    {
        $this->doctrine = $doctrine;
        $this->factory  = $factory;
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
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $items = $this->doctrine->getRepository('SymforiumCoreBundle:MenuItem')->findAll();
        foreach ($items as $item) {
            $menu->addChild($item->getDisplay(), ['uri' => $item->getUrl()])
                ->setAttribute('title', $item->getTitle());
        }

        return $menu;
    }
}
 