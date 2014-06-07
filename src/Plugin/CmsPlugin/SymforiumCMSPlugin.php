<?php

/**
 * This file is part of symforium-cms-extension
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Plugin\CmsPlugin;

use Symforium\Core\Plugin;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class SymforiumCmsPlugin extends Plugin
{
    /**
     * {@inheritDoc}
     */
    public static function getRoutingFile()
    {
        return '@SymforiumCmsPlugin/Resources/config/routing.yml';
    }

    /**
     * {@inheritDoc}
     */
    public static function getMenuClass()
    {
        return 'Symforium\Plugin\CmsPlugin\Menu\CmsMenu';
    }
}
 