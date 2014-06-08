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
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 * @Sensio\Route("/settings")
 */
class SettingsController extends Controller
{
    /**
     * @param Request $request
     *
     * @return array
     *
     * @Sensio\Route("/application")
     * @Sensio\Template()
     */
    public function applicationAction(Request $request)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Backend", $this->generateUrl("symforium_core_admin_index"));
        $breadcrumbs->addItem("Application Settings", $this->generateUrl("symforium_core_settings_application"));

        $formData = $this->buildForm($request, 'settings_application');

        return array_merge(['title' => 'Application Settings'], $formData);
    }
    /**
     * @param Request $request
     *
     * @return array
     *
     * @Sensio\Route("/database")
     * @Sensio\Template()
     */
    public function databaseAction(Request $request)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Backend", $this->generateUrl("symforium_core_admin_index"));
        $breadcrumbs->addItem("Application Settings", $this->generateUrl("symforium_core_settings_application"));

        $formData = $this->buildForm($request, 'settings_database');

        return array_merge(['title' => 'Database Settings'], $formData);
    }

    private function buildForm(Request $request, $type)
    {
        $configuration = $this->get('symforium.core_bundle.configuration_helper');

        $data = $request->request->get($type, $configuration->getParameters());
        $form = $this->createForm($type, $data, ['button_text' => 'submit.save']);

        $errors = [];
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $configuration->saveParameters($data);

                $this->get('session')->getFlashBag()->add('notice', 'Your changes were saved!');
            } else {
                $errors = $form->getErrors(true);
            }
        }

        return ['form' => $form->createView(), 'errors' => $errors];
    }
}

