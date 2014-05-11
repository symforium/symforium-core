<?php

namespace Symforium\Core\Bundle\InstallerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symforium\Core\Bundle\InstallerBundle\Form\InstallerForm;

class InstallerController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $form = $this->createForm(new InstallerForm());
        $view = $form->createView();

        return ['form' => $form->createView()];
    }
}
