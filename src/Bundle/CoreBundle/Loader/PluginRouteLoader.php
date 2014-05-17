<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Core\Bundle\CoreBundle\Loader;

use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;
use Symforium\Core\Plugin;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class PluginRouteLoader extends Loader
{
    /**
     * @var bool $loaded
     */
    private $loaded = false;

    /**
     * @var array|Plugin[] $plugins
     */
    private $plugins = array();

    /**
     * @param array $plugins
     */
    public function __construct(array $plugins)
    {
        $this->plugins = $plugins;
    }

    /**
     * {@inheritDoc}
     */
    public function load($resource, $type = null)
    {
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add the "extra" loader twice');
        }

        $collection = new RouteCollection();

        foreach ($this->plugins as $plugin) {
            $routingFile = $plugin::getRoutingFile();
            if ($routingFile === false) {
                continue;
            }

            $importedRoutes = $this->import($routingFile);
            $collection->addCollection($importedRoutes);
        }

        $this->loaded = true;

        return $collection;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($resource, $type = null)
    {
        return 'symforium' === $type;
    }
}
 