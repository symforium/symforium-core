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

use Sensio\Bundle\FrameworkExtraBundle\Configuration as Sensio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symforium\Bundle\CoreBundle\Entity\MenuItem;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 * @Sensio\Route("/menu")
 */
class MenuController extends Controller
{
    /**
     * @param Request  $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Sensio\Route("/add")
     * @Sensio\Template()
     */
    public function addAction(Request $request)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Backend", $this->generateUrl("symforium_core_admin_index"));
        $breadcrumbs->addItem("Menu Settings", $this->generateUrl("symforium_core_settings_menu"));
        $breadcrumbs->addItem('Adding New Menu Item', $this->generateUrl("symforium_core_menu_add"));

        $menuItem = new MenuItem();
        $form = $this->createForm('settings_menu_item', $menuItem, ['button_text' => 'submit.save']);

        $errors = [];
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($menuItem);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Your changes were saved!');

                return $this->redirect($this->generateUrl('symforium_core_settings_menu'));
            } else {
                $errors = $form->getErrors(true);
            }
        }

        return [
            'title' => 'Adding New Menu Item',
            'menuItem' => $menuItem,
            'form' => $form->createView(),
            'errors' => $errors
        ];
    }

    /**
     * @param Request  $request
     * @param MenuItem $menuItem
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Sensio\Route("/{menuItem}/edit")
     * @Sensio\Template()
     */
    public function editAction(Request $request, MenuItem $menuItem)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Backend", $this->generateUrl("symforium_core_admin_index"));
        $breadcrumbs->addItem("Menu Settings", $this->generateUrl("symforium_core_settings_menu"));
        $breadcrumbs->addItem(
            "Editing Menu: ".$menuItem->getDisplay(),
            $this->generateUrl("symforium_core_menu_edit", ['menuItem' => $menuItem->getId()])
        );

        $form = $this->createForm('settings_menu_item', $menuItem, ['button_text' => 'submit.save']);

        $errors = [];
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($menuItem);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Your changes were saved!');

                return $this->redirect($this->generateUrl('symforium_core_settings_menu'));
            } else {
                $errors = $form->getErrors(true);
            }
        }

        return [
            'title' => 'Editing Menu: '.$menuItem->getDisplay(),
            'menuItem' => $menuItem,
            'form' => $form->createView(),
            'errors' => $errors
        ];
    }

    /**
     * @param MenuItem $menuItem
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Sensio\Route("/{menuItem}/delete")
     */
    public function deleteAction(MenuItem $menuItem)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($menuItem);
        $em->flush();

        return $this->redirect($this->generateUrl('symforium_core_settings_menu'));
    }
}

