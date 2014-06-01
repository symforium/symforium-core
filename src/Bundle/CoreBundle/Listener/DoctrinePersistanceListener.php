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

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class DoctrinePersistanceListener
{
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

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->userListener($args->getEntity());
        $this->dateListener($args->getEntity());
    }

    /**
     * @param object $entity
     */
    public function userListener($entity)
    {
        $token = $this->container->get('security.context')->getToken();
        if (!is_object($token) || !$token->isAuthenticated()) {
            return;
        }

        $user = $token->getUser();
        if (method_exists($entity, 'setInsertUser') && $entity->getInsertUser() === null) {
            $entity->setInsertUser($user);
        }
        if (method_exists($entity, 'setModifiedUser')) {
            $entity->setModifiedUser($user);
        }
    }

    /**
     * @param object $entity
     */
    public function dateListener($entity)
    {
        if (method_exists($entity, 'setInsertDate') && $entity->getInsertDate() === null) {
            $entity->setInsertDate(new \DateTime());
        }
        if (method_exists($entity, 'setModifiedDate')) {
            $entity->setModifiedDate(new \DateTime());
        }
    }
}
 