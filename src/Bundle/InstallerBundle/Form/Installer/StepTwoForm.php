<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Bundle\InstallerBundle\Form\Installer;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints;
use Symforium\Bundle\InstallerBundle\Form\AbstractInstallerForm;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class StepTwoForm extends AbstractInstallerForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'mysqlHost',
                'text',
                [
                    'label'       => $this->trans('step_two.mysql_host.label'),
                    'attr'        => [
                        'value' => '127.0.0.1',
                        'class' => 'form-control'
                    ],
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(['min' => 3])
                    ]
                ]
            )
            ->add(
                'mysqlDatabase',
                'text',
                [
                    'label'       => $this->trans('step_two.mysql_database.label'),
                    'attr'        => [
                        'placeholder' => $this->trans('step_two.mysql_database.placeholder'),
                        'class' => 'form-control'
                    ],
                    'constraints' => [
                        new Constraints\NotBlank()
                    ]
                ]
            )
            ->add(
                'mysqlUser',
                'text',
                [
                    'label'       => $this->trans('step_two.mysql_user.label'),
                    'attr'        => [
                        'placeholder' => $this->trans('step_two.mysql_user.placeholder'),
                        'class'       => 'form-control'
                    ],
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(['min' => 3])
                    ]
                ]
            )
            ->add(
                'mysqlPassword',
                'password',
                [
                    'label'       => $this->trans('step_two.mysql_password.label'),
                    'attr'        => [
                        'class' => 'form-control'
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
        return 'installer_step_two';
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
 