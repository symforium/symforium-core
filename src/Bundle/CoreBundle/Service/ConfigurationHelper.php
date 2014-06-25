<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Bundle\CoreBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class ConfigurationHelper
{
    /**
     * @var string[] $parameterWhitelist
     */
    private static $parameterWhitelist = [
        'site_name',
        'database_type',
        'database_host',
        'database_port',
        'database_name',
        'database_user',
        'database_password'
    ];

    /**
     * @var ContainerInterface $container
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        $parameters = [];
        foreach (self::$parameterWhitelist as $name) {
            $parameters[$name] = $this->container->hasParameter($name) ? $this->container->getParameter($name) : null;
        }

        return $parameters;
    }

    /**
     * @param array $data
     * @param bool  $finished
     */
    public function saveParameters(array $data = [], $finished = false)
    {
        $file       = $this->container->getParameter('kernel.root_dir').'/config/parameters.yml';
        $parameters = file_exists($file) ? Yaml::parse($file)['parameters'] : [];

        foreach ($data as $key => $value) {
            if (in_array($key, self::$parameterWhitelist)) {
                $parameters[$key] = $value;
            }
        }

        if ($finished) {
            $parameters['installed'] = true;
        }

        file_put_contents($file, Yaml::dump(['parameters' => $parameters], 4, 8));
    }
}
 