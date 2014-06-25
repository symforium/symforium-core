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
class MenuForm extends AbstractForm
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'display',
                'text',
                [
                    'label'       => $this->trans('menu.display.label'),
                    'attr'        => [
                        'placeholder' => $this->trans('menu.display.placeholder'),
                        'class'       => 'form-control'
                    ],
                    'description' => $this->trans('menu.display.description'),
                    'constraints' => [
                        new Constraints\NotBlank()
                    ]
                ]
            )
            ->add(
                'title',
                'text',
                [
                    'label'       => $this->trans('menu.title.label'),
                    'attr'        => [
                        'placeholder' => $this->trans('menu.title.placeholder'),
                        'class'       => 'form-control'
                    ],
                    'description' => $this->trans('menu.title.description'),
                    'constraints' => [
                        new Constraints\NotBlank()
                    ]
                ]
            )
            ->add(
                'url',
                'text',
                [
                    'label'       => $this->trans('menu.url.label'),
                    'attr'        => [
                        'placeholder' => $this->trans('menu.url.placeholder'),
                        'class'       => 'form-control'
                    ],
                    'description' => $this->trans('menu.url.description'),
                    'constraints' => [
                        new Constraints\NotBlank()
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
        return 'settings_menu_item';
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'button_text' => 'submit.step.next',
                'csrf_protection' => false
            ]
        );
    }
}
 