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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;
use Symforium\Plugin\CmsPlugin\Entity\Page;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class BackendController extends Controller
{
    /**
     * @return array
     *
     * @Config\Route("")
     * @Config\Template()
     */
    public function viewAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Backend", $this->generateUrl("symforium_core_admin_index"));
        $breadcrumbs->addItem("Cms Pages", $this->generateUrl("symforium_plugin_cmsplugin_backend_view"));

        $repo = $this->getDoctrine()->getManager()->getRepository('SymforiumCmsPlugin:Page');

        return [
            'title' => 'View Pages',
            'pages' => $repo->findAll()
        ];
    }

    /**
     * @param Page $page
     *
     * @Config\Route("/delete/{page}")
     * @return JsonResponse
     */
    public function deleteAction(Page $page)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($page);
        $manager->flush();

        return $this->redirect($this->generateUrl('symforium_plugin_cmsplugin_backend_view'));
    }

    /**
     * @param Request $request
     *
     * @return array
     *
     * @Config\Route("/add")
     * @Config\Template("SymforiumCmsPlugin:Backend:edit.html.twig")
     */
    public function addAction(Request $request)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Backend", $this->generateUrl("symforium_core_admin_index"));
        $breadcrumbs->addItem("Cms Pages", $this->generateUrl("symforium_plugin_cmsplugin_backend_view"));
        $breadcrumbs->addItem("Add a New Page", $this->generateUrl("symforium_plugin_cmsplugin_backend_add"));

        return $this->handleForm($request);
    }

    /**
     * @param Request $request
     * @param Page    $page
     *
     * @return array
     *
     * @Config\Route("/edit/{page}")
     * @Config\Template()
     */
    public function editAction(Request $request, Page $page)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Backend", $this->generateUrl("symforium_core_admin_index"));
        $breadcrumbs->addItem("Cms Pages", $this->generateUrl("symforium_plugin_cmsplugin_backend_view"));
        $breadcrumbs->addItem("Edit Page", $this->generateUrl("symforium_plugin_cmsplugin_backend_edit", ['page' => $page->getId()]));

        return $this->handleForm($request, $page);
    }

    /**
     * @param Request $request
     * @param Page    $page
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function handleForm(Request $request, Page $page = null)
    {
        $editing = true;
        if ($page === null) {
            /** @var \Symfony\Component\Translation\Translator $translator */
            $translator = $this->get('translator');

            $editing = false;
            $page    = new Page();
            $page->setContent($translator->trans('symforium.cms.add.sample', [], 'SymforiumCMS'));
        }

        $errors = [];
        $form   = $this->createForm(
            'symforium_cms_page',
            $page,
            [
                'action' => $editing
                    ? $this->generateUrl('symforium_plugin_cmsplugin_backend_edit', ['page' => $page->getId()])
                    : $this->generateUrl('symforium_plugin_cmsplugin_backend_add')
            ]
        );

        if ($request->isMethod('post')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->persist($page);
                $this->getDoctrine()->getManager()->flush();
                $this->get('router_cache_clearer')->clear();

                return $this->redirect($this->generateUrl('symforium_plugin_cmsplugin_backend_view'));
            } else {
                $errors = $form->getErrors();
            }
        }

        return [
            'page'   => $page,
            'title'  => $editing ? 'Editing Page: '.$page->getTitle() : 'Adding a new Page',
            'form'   => $form->createView(),
            'errors' => $errors
        ];
    }
}
 