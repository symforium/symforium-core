<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Sensio;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class AdminController extends Controller
{
    /**
     * @return array
     *
     * @Sensio\Route("")
     * @Sensio\Template()
     */
    public function indexAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Backend", $this->generateUrl("symforium_core_admin_index"));

        return ['title' => 'Dashboard'];
    }
}
 