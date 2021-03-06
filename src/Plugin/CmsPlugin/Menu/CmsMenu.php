<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Plugin\CmsPlugin\Menu;

use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\Request;
use Symforium\Core\MenuInterface;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class CmsMenu implements MenuInterface
{
    /**
     * {@inheritdoc}
     */
    public function build(Request $request, ItemInterface $menu)
    {
        $cms = $menu->addChild('CMS', ['uri' => '#'])
            ->setAttribute('icon', 'pencil-square');

        $cms->addChild('View Pages', ['route' => 'symforium_plugin_cmsplugin_backend_view'])
            ->setAttribute('icon', 'files-o');

        $add = $cms->addChild('Add a new Page', ['route' => 'symforium_plugin_cmsplugin_backend_add'])
            ->setAttribute('icon', 'plus-square');

        $cmsUrls = ['symforium_plugin_cmsplugin_backend_edit'];
        if (in_array($request->attributes->get('_route'), $cmsUrls)) {
            $cms->setCurrent(true);
        }
    }
}
 