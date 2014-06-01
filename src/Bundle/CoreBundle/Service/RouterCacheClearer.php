<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Core\Bundle\CoreBundle\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class RouterCacheClearer
{
    /**
     * @var string $cacheDir
     */
    private $cacheDir;

    public function __construct($cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }

    public function clear()
    {
        $filesystem = new Filesystem();

        $finder = new Finder();
        $finder->files()->in($this->cacheDir);

        $finder->name('/Url(Generator|Matcher).php(.meta)?$/');

        $filesystem->remove($finder);
    }
}
 