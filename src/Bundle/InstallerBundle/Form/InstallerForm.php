<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Core\Bundle\InstallerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

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
                    ]
                ]
            )
            ->add(
                'mysqlUser',
                'text',
                [
                    'label' => 'MySQL User',
                    'attr'  => [
                        'placeholder' => 'root',
                        'class'       => 'form-control'
                    ]
                ]
            )
            ->add(
                'mysqlPassword',
                'password',
                [
                    'label' => 'MySQL Password',
                    'attr'  => [
                        'placeholder' => 'root',
                        'class'       => 'form-control'
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
                ]
            )
            ->add(
                'submit',
                'submit',
                [
                    'label' => 'Install Symforium',
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
}
 