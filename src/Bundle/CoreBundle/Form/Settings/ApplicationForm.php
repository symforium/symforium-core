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
class ApplicationForm extends AbstractForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'site_name',
                'text',
                [
                    'label'       => $this->trans('application.site_name.label'),
                    'attr'        => [
                        'placeholder' => $this->trans('application.site_name.placeholder'),
                        'class'       => 'form-control'
                    ],
                    'description' => $this->trans('application.site_name.description'),
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
        return 'settings_application';
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
 