<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Bundle\InstallerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class InstallerForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'forumName',
                'text',
                [
                    'label' => 'Forum Name',
                    'attr'  => [
                        'placeholder' => 'Symforium',
                        'class'       => 'form-control'
                    ],
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(['min' => 3])
                    ]
                ]
            )
            ->add(
                'mysqlHost',
                'text',
                [
                    'label' => 'MySQL Host',
                    'attr'  => [
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
                'mysqlUser',
                'text',
                [
                    'label' => 'MySQL User (Use \':\' to signify port)',
                    'attr'  => [
                        'placeholder' => 'root',
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
                    'label' => 'MySQL Password',
                    'attr'  => [
                        'class'       => 'form-control'
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
                    'label' => 'MySQL Database',
                    'attr'  => [
                        'value' => 'symforium',
                        'class' => 'form-control'
                    ],
                    'constraints' => [
                        new Constraints\NotBlank()
                    ]
                ]
            )
            ->add(
                'adminUsername',
                'text',
                [
                    'label' => 'Username',
                    'attr'  => [
                        'value' => 'admin',
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
                    'label' => 'Email',
                    'attr'  => [
                        'placeholder' => 'john@doe.com',
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
                    'label'           => 'Repeat your Password',
                    'invalid_message' => 'The password fields must match.',
                    'options'         => ['attr' => ['class' => 'form-control']],
                    'required'        => true,
                    'first_options'   => ['label' => 'Password'],
                    'second_options'  => ['label' => 'Repeat Password'],
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(['min' => 7])
                    ]
                ]
            )
            ->add(
                'submit',
                'submit',
                [
                    'label' => 'Install Symforium!',
                    'attr'  => [
                        'class' => 'btn btn-success'
                    ]
                ]
            )
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'symforium_installer';
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
 