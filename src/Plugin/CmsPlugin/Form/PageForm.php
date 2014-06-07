<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Plugin\CmsPlugin\Form;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class PageForm extends AbstractType
{
    /**
     * @var Router $router
     */
    private $router;

    /**
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction($options['action'])
            ->setMethod('POST')
        ;

        $builder
            ->add(
                'title',
                'text',
                [
                    'attr'        => [
                        'placeholder' => 'Page Title'
                    ],
                    'required'    => true,
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(['min' => 3])
                    ]
                ]
            )
            ->add(
                'url',
                'text',
                [
                    'attr'        => [
                        'placeholder' => 'URL (Relative)'
                    ],
                    'required'    => true,
                    'constraints' => [
                        new Constraints\NotBlank()
                    ]
                ]
            )
            ->add('content', 'textarea', ['required' => true])
            ->add('published', 'checkbox')
            ->add(
                'submit',
                'submit',
                [
                    'label' => 'Save Page',
                    'attr'  => ['class' => 'btn btn-lg btn-inverse btn-block']
                ]
            )
        ;
    }

    /**
     * @return Router
     */
    protected function getRouter()
    {
        return $this->router;
    }

    /**
     * @param string $route
     * @param array $parameters
     *
     * @return string
     */
    protected function generateUrl($route, array $parameters = [])
    {
        return $this->router->generate($route, $parameters);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'symforium_cms_page';
    }

    /**
     * {@inheritDoc{
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class' => 'Symforium\Plugin\CmsPlugin\Entity\Page']);
    }
}
 