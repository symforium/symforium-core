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
class DatabaseForm extends AbstractForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'database_type',
                'choice',
                [
                    'label'       => $this->trans('database.database_type.label'),
                    'choices'     => [
                        'pdo_mysql' => $this->trans('database.database_type.choices.pdo_mysql'),
                        'pdo_sqlite' => $this->trans('database.database_type.choices.pdo_sqlite'),
                        'pdo_pgsql' => $this->trans('database.database_type.choices.pdo_pgsql')
                    ],
                    'description' => $this->trans('database.database_type.description'),
                    'required'    => true,
                    'empty_value' => 'Pick a Database Type',
                    'attr'        => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'database_host',
                'text',
                [
                    'label'       => $this->trans('database.database_host.label'),
                    'attr'        => [
                        'value' => '127.0.0.1',
                        'class' => 'form-control'
                    ],
                    'description' => $this->trans('database.database_host.description'),
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(['min' => 3])
                    ]
                ]
            )
            ->add(
                'database_name',
                'text',
                [
                    'label'       => $this->trans('database.database_name.label'),
                    'attr'        => [
                        'placeholder' => $this->trans('database.database_name.placeholder'),
                        'class' => 'form-control'
                    ],
                    'description' => $this->trans('database.database_name.description'),
                    'constraints' => [
                        new Constraints\NotBlank()
                    ]
                ]
            )
            ->add(
                'database_user',
                'text',
                [
                    'label'       => $this->trans('database.database_user.label'),
                    'attr'        => [
                        'placeholder' => $this->trans('database.database_user.placeholder'),
                        'class'       => 'form-control'
                    ],
                    'description' => $this->trans('database.database_user.description'),
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(['min' => 3])
                    ]
                ]
            )
            ->add(
                'database_password',
                $options['password_type'],
                [
                    'label'       => $this->trans('database.database_password.label'),
                    'attr'        => [
                        'class' => 'form-control'
                    ],
                    'description' => $this->trans('database.database_password.description'),
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
                    'label' => $this->trans($options['button_text']),
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
        return 'settings_database';
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'button_text' => 'submit.step.next',
                'password_type' => 'password',
                'csrf_protection' => false
            ]
        );
    }
}
 