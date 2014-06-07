<?php

/**
 * This file is part of symforium-cms-extension
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Plugin\CmsPlugin\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symforium\Plugin\CmsPlugin\Entity\Page;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class FrontendController extends Controller
{
    /**
     * @return array
     * @Config\Template()
     */
    public function indexAction(Request $request)
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('SymforiumCmsPlugin:Page');
        $page = $repo->findOneBy(['id' => $request->attributes->get('page_id'), 'published' => 1]);

        if ($page === null) {
            throw new NotFoundHttpException('A page was found, but it is not published.');
        }

        return ['page' => $page];
    }

    /**
     * @return array
     *
     * @Config\Template()
     */
    public function failoverAction()
    {
        return [];
    }
}
 