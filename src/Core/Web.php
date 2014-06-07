<?php

/**
 * This file is part of content.videosz.com
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Core;

use Aequasi\Environment\Environment;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class Web
{
    /**
     * @var Environment
     */
    protected $environment;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Kernel
     */
    protected $kernel;

    /**
     * @param Kernel $kernel
     *
     * @return Web
     */
    public static function create(Kernel $kernel)
    {
        return new static($kernel);
    }

    /**
     *
     */
    public function __construct(Kernel $kernel)
    {
        $this->environment = new Environment();
        $this->buildRequest();
        $this->buildKernel($kernel);
    }

    /**
     * Build the Request
     */
    private function buildRequest()
    {
        Request::enableHttpMethodParameterOverride();
        $this->request = Request::createFromGlobals();
    }

    /**
     * Build the Kernel
     *
     * @param Kernel $kernel
     */
    private function buildKernel(Kernel $kernel)
    {
        $this->kernel = $kernel;
        $this->kernel->initialize($this->environment);
        //$this->kernel->loadClassCache();
    }

    /**
     *
     */
    public function run()
    {
        $response = $this->kernel->handle($this->request);
        $response->send();
        $this->kernel->terminate($this->request, $response);
    }
}
