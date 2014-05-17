<?php

/**
 * This file is part of symforium-cms-extension
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Core;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
abstract class Plugin extends Bundle
{
    /**
     * Returns the resource name of the routing file
     *
     * @return bool|string
     */
    public static function getRoutingFile()
    {
        return false;
    }

    /**
     * Camelizes a string.
     *
     * @param string $id A string to camelize
     *
     * @return string The camelized string
     */
    public static function camelize($id)
    {
        return strtr(ucwords(strtr($id, array('_' => ' ', '.' => '_ ', '\\' => '_ '))), array(' ' => ''));
    }

    /**
     * A string to underscore.
     *
     * @param string $id The string to underscore
     *
     * @return string The underscored string
     */
    public static function underscore($id)
    {
        return strtolower(preg_replace(array('/([A-Z]+)([A-Z][a-z])/', '/([a-z\d])([A-Z])/'), array('\\1_\\2', '\\1_\\2'), strtr($id, '_', '.')));
    }
}
 