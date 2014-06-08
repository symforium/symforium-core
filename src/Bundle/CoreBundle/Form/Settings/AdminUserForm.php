<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Bundle\CoreBundle\Form\Settings;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints;
use Symforium\Bundle\CoreBundle\Form\AbstractForm;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class AdminUserForm extends AbstractForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'admin_username',
                'text',
                [
                    'label'       => $this->trans('admin_user.admin_username.label'),
                    'attr'        => [
                        'value' => $this->trans('admin_user.admin_username.value'),
                        'class' => 'form-control'
                    ],
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(['min' => 3])
                    ]
                ]
            )
            ->add(
                'admin_email',
                'email',
                [
                    'label'       => $this->trans('admin_user.admin_email.label'),
                    'attr'        => [
                        'placeholder' => $this->trans('admin_user.admin_email.placeholder'),
                        'class'       => 'form-control'
                    ],
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Email()
                    ]
                ]
            )
            ->add(
                'admin_password',
                'repeated',
                [
                    'type'            => 'password',
                    'invalid_message' => 'The password fields must match.',
                    'options'         => ['attr' => ['class' => 'form-control']],
                    'required'        => true,
                    'first_options'   => ['label' => $this->trans('admin_user.admin_password.label'),],
                    'second_options'  => ['label' => $this->trans('admin_user.admin_password_repeat.label'),],
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
        return 'settings_admin_user';
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
 