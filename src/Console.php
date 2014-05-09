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

use Aequasi\Environment\SymfonyEnvironment;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Debug\Debug;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class Console
{
    /**
     * @param Kernel $kernel
     *
     * @return Console
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
        set_time_limit(0);
        $input       = new ArgvInput();
        $environment = new SymfonyEnvironment($input);
        $kernel->initialize($environment);

        if ($environment->isDebug()) {
            //Debug::enable();
        }


        $application = new Application($kernel);
        $application->run($input);
    }
}
