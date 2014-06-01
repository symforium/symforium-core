<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Core;

use Aequasi\Environment\Environment;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use FOS\UserBundle\FOSUserBundle;
use Knp\Bundle\MarkdownBundle\KnpMarkdownBundle;
use Knp\Bundle\MenuBundle\KnpMenuBundle;
use Sensio\Bundle as SensioBundle;
use Symfony\Bundle as SymfonyBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel as SymfonyKernel;
use Symforium\Plugin\CmsPlugin\SymforiumCmsPlugin;
use WhiteOctober\BreadcrumbsBundle\WhiteOctoberBreadcrumbsBundle;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
abstract class Kernel extends SymfonyKernel
{
    /**
     * Constructor.
     *
     * @api
     */
    final public function __construct()
    {
        $this->rootDir = $this->getRootDir();
        $this->name    = $this->getName();
    }

    protected function getKernelParameters()
    {
        $plugins = array();
        foreach ($this->bundles as $name => $bundle) {
            if ($bundle instanceof Plugin) {
                $plugins[$name] = get_class($bundle);
            }
        }

        return array_merge(
            parent::getKernelParameters(),
            array(
                'symforium.core_dir' => realpath(__DIR__),
                'symforium.plugins'  => $plugins
            )
        );
    }

    /**
     * @param Environment $environment
     */
    public function initialize(Environment $environment)
    {
        $this->environment = $environment->getType();
        $this->debug       = $environment->isDebug();

        if ($this->debug) {
            $this->startTime = microtime(true);
        }
    }

    /**
     * {@inheritDoc}
     */
    final public function registerBundles()
    {
        $bundles = [
            new SymfonyBundle\FrameworkBundle\FrameworkBundle(),
            new SymfonyBundle\SecurityBundle\SecurityBundle(),
            new SymfonyBundle\TwigBundle\TwigBundle(),
            new SymfonyBundle\MonologBundle\MonologBundle(),
            new SymfonyBundle\SwiftmailerBundle\SwiftmailerBundle(),
            new DoctrineBundle(),
            new SensioBundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new WhiteOctoberBreadcrumbsBundle(),
            new KnpMarkdownBundle(),
            new FOSUserBundle(),
            new KnpMenuBundle(),
            //new AequasiCacheBundle(),
            new Bundle\CoreBundle\SymforiumCoreBundle(),
            new Bundle\UserBundle\SymforiumUserBundle()
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'])) {
            $bundles = array_merge(
                $bundles,
                [
                    new SymfonyBundle\WebProfilerBundle\WebProfilerBundle(),
                    new SensioBundle\DistributionBundle\SensioDistributionBundle(),
                    new SensioBundle\GeneratorBundle\SensioGeneratorBundle(),
                    new Bundle\InstallerBundle\SymforiumInstallerBundle()
                ]
            );
        }

        $bundles = array_merge($bundles, $this->registerPlugins());

        return $bundles;
    }

    /**
     * @return array
     */
    protected function registerPlugins()
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    final public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/Application/config/config_'.$this->environment.'.yml');
        $this->registerSymforiumConfiguration($loader);
    }

    /**
     * @param LoaderInterface $loader
     *
     * @return mixed
     */
    abstract public function registerSymforiumConfiguration(LoaderInterface $loader);
}
 