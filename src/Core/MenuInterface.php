<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Core;

use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
interface MenuInterface
{
    /**
     * @param Request       $request
     * @param ItemInterface $menu
     */
    public function build(Request $request, ItemInterface $menu);
}
 