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
class StepThreeForm extends AbstractInstallerForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'adminUsername',
                'text',
                [
                    'label'       => $this->trans('step_three.admin_username.label'),
                    'attr'        => [
                        'value' => $this->trans('step_three.admin_username.value'),
                        'class' => 'form-control'
                    ],
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(['min' => 3])
                    ]
                ]
            )
            ->add(
                'adminEmail',
                'email',
                [
                    'label'       => $this->trans('step_three.admin_email.label'),
                    'attr'        => [
                        'placeholder' => $this->trans('step_three.admin_email.placeholder'),
                        'class'       => 'form-control'
                    ],
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Email()
                    ]
                ]
            )
            ->add(
                'adminPassword',
                'repeated',
                [
                    'type'            => 'password',
                    'invalid_message' => 'The password fields must match.',
                    'options'         => ['attr' => ['class' => 'form-control']],
                    'required'        => true,
                    'first_options'   => ['label' => $this->trans('step_three.admin_password.label'),],
                    'second_options'  => ['label' => $this->trans('step_three.admin_password_repeat.label'),],
                    'constraints'     => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(['min' => 7])
                    ]
                ]
            )
            ->add(
                'submit',
                'submit',
                [
                    'label' => $this->trans('step.final'),
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
        return 'installer_step_three';
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
 