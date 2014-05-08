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
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel as SymfonyKernel;
use Aequasi\Bundle\CacheBundle\AequasiCacheBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle;
use Symfony\Bundle as SymfonyBundle;
use Sensio\Bundle as SensioBundle;
use WhiteOctober\BreadcrumbsBundle\WhiteOctoberBreadcrumbsBundle;
use Knp\Bundle\MenuBundle\KnpMenuBundle;

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
        $this->name = $this->getName();
    }

    /**
     * @param Environment $environment
     */
    final public function initialize(Environment $environment)
    {
        $this->environment = $environment->getType();
        $this->debug = $environment->isDebug();

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
            new SensioFrameworkExtraBundle(),
            new WhiteOctoberBreadcrumbsBundle(),
            //new KnpMenuBundle(),
            new AequasiCacheBundle(),
            new Bundle\CoreBundle\SymforiumCoreBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'])) {
            $bundles[] = new SymfonyBundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new SensioBundle\DistributionBundle\SensioDistributionBundle();
        }

        $bundles = array_merge($bundles, $this->registerSymforiumBundles());

        return $bundles;
    }

    /**
     * @return array
     */
    protected function registerSymforiumBundles()
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    final public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/Application/config/config.yml');
        $this->registerSymforiumConfiguration($loader);
    }

    /**
     * @param LoaderInterface $loader
     *
     * @return mixed
     */
    abstract public function registerSymforiumConfiguration(LoaderInterface $loader);
}
 