<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Core\Bundle\InstallerBundle\Form\Installer;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints;
use Symforium\Core\Bundle\InstallerBundle\Form\AbstractInstallerForm;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class StepOneForm extends AbstractInstallerForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'forumName',
                'text',
                [
                    'label'       => $this->trans('step_one.forum_name.label'),
                    'attr'        => [
                        'placeholder' => $this->trans('step_one.forum_name.placeholder'),
                        'class'       => 'form-control'
                    ],
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(['min' => 3])
                    ]
                ]
            )
            ->add(
                'submit',
                'submit',
                [
                    'label' => $this->trans('step.next'),
                    'attr'  => [
                        'class' => 'btn btn-success'
                    ]
                ]
            );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'installer_step_one';
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'csrf_protection' => false
            ]
        );
    }
}
 