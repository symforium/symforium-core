<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Bundle\CoreBundle\Twig;

use Symfony\Component\Form\FormView;
use Twig_Environment;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class DescriptionExtension extends Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'description';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction(
                'form_description',
                [$this, 'renderDescription'],
                ['needs_environment' => true, 'is_safe' => ['html']]
            )
        ];
    }

    public function renderDescription(Twig_Environment $twig, FormView $field)
    {
        return $twig->render('SymforiumCoreBundle:Twig:description.html.twig', ['field' => $field]);
    }
}
 