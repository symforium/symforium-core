<?php

namespace Symforium\Bundle\InstallerBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;

class InstallerController extends Controller
{
    /**
     * @Config\Route("/", name="symforium_installer_index")
     * @Config\Template()
     */
    public function indexAction(Request $request)
    {
        if ($this->isConfigurationSet()) {
            return $this->forward('SymforiumInstallerBundle:Installer:error');
        }

        return [];
    }

    /**
     * @Config\Route("/step/1", name="symforium_installer_step_one")
     * @Config\Template()
     */
    public function stepOneAction(Request $request)
    {
        if ($this->isConfigurationSet()) {
            return $this->forward('SymforiumInstallerBundle:Installer:error');
        }

        $form = $this->createForm('settings_step_one', $request->query->get('settings_step_one'));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->saveParameters($data);

                return $this->redirect($this->generateUrl('symforium_installer_step_two'));
            } else {
                $errors = $form->getErrors(true);
            }
        }

        return ['form' => $form->createView(), 'errors' => isset($errors) ? $errors : []];
    }

    /**
     * @Config\Route("/step/2", name="symforium_installer_step_two")
     * @Config\Template()
     */
    public function stepTwoAction(Request $request)
    {
        if ($this->isConfigurationSet()) {
            return $this->forward('SymforiumInstallerBundle:Installer:error');
        }

        $form = $this->createForm('settings_step_two', $request->query->get('settings_step_two'));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->saveParameters($data);

                return $this->redirect($this->generateUrl('symforium_settings_step_three'));
            } else {
                $errors = $form->getErrors(true);
            }
        }

        return ['form' => $form->createView(), 'errors' => isset($errors) ? $errors : []];
    }

    /**
     * @Config\Route("/step/3", name="symforium_installer_step_three")
     * @Config\Template()
     */
    public function stepThreeAction(Request $request)
    {
        if ($this->isConfigurationSet()) {
            return $this->forward('SymforiumInstallerBundle:Installer:error');
        }

        $form = $this->createForm('settings_step_three', $request->query->get('settings_step_three'));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->createUser($data);

                return $this->redirect($this->generateUrl('symforium_settings_step_four'));
            } else {
                $errors = $form->getErrors(true);
            }
        }

        return ['form' => $form->createView(), 'errors' => isset($errors) ? $errors : []];
    }

    /**
     * @Config\Route("/step/4", name="symforium_installer_step_four")
     * @Config\Template()
     */
    public function stepFourAction()
    {
        if ($this->isConfigurationSet()) {
            return $this->forward('SymforiumInstallerBundle:Installer:error');
        }

        $this->saveParameters([], true);

        return ['url' => $this->generateUrl('symforium_core_admin_index')];
    }

    /**
     * @Config\Template()
     */
    public function errorAction()
    {
        return ['file' => $this->container->getParameter('kernel.root_dir').'/config/parameters.yml'];
    }

    /**
     * @param array $data
     */
    private function createUser(array $data)
    {
        /** @var \FOS\UserBundle\Doctrine\UserManager $manager */
        $manager = $this->get('fos_user.user_manager');

        if (!($user = $manager->findUserByUsername($data['adminUsername']))) {
            $user = $manager->createUser();
        }

        $user->setEmail($data['adminEmail'])
            ->setEnabled(1)
            ->setPlainPassword($data['adminPassword'])
            ->setRoles(['ROLE_SUPER_ADMIN', 'ROLE_ADMIN', 'ROLE_USER'])
            ->setSuperAdmin(1)
            ->setUsername($data['adminUsername']);

        $manager->updateUser($user);
    }

    /**
     * @return bool
     */
    private function isConfigurationSet()
    {
        $file = $this->container->getParameter('kernel.root_dir').'/config/parameters.yml';
        if (!file_exists($file)) {
            return false;
        }

        $parameters = Yaml::parse($file);
        if (empty($parameters) || empty($parameters['parameters'])) {
            return false;
        }

        if (!isset($parameters['parameters']['installed']) || $parameters['parameters']['installed'] === false) {
            return false;
        }

        return true;
    }
}
