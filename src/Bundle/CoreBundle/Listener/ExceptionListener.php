<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Core\Bundle\CoreBundle\Listener;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class ExceptionListener
{
    /**
     * @var TwigEngine $templating
     */
    private $templating;

    public function __construct(TwigEngine $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $event->setResponse(
            $this->templating->renderResponse(
                'SymforiumCoreBundle:Exception:index.html.twig',
                ['exception' => $event->getException(), 'type' => get_class($event->getException())]
            )
        );
    }
}
 