<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Core\Bundle\CoreBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 *
 * @ORM\MappedSuperclass
 */
trait UserAwareTrait
{
    /**
     * @var \Symforium\Core\Bundle\CoreBundle\Entity\User $insertUser
     *
     * @ORM\ManyToOne(targetEntity="\Symforium\Core\Bundle\CoreBundle\Entity\User")
     * @ORM\JoinColumn(name="insert_user_id", referencedColumnName="id", nullable=false)
     */
    protected $insertUser;

    /**
     * @var \Symforium\Core\Bundle\CoreBundle\Entity\User $modifiedUser
     *
     * @ORM\ManyToOne(targetEntity="\Symforium\Core\Bundle\CoreBundle\Entity\User")
     * @ORM\JoinColumn(name="modified_user_id", referencedColumnName="id", nullable=false)
     */
    protected $modifiedUser;

    /**
     * @return User
     */
    public function getInsertUser()
    {
        return $this->insertUser;
    }

    /**
     * @param User $insertUser
     *
     * @return UserAwareTrait
     */
    public function setInsertUser($insertUser)
    {
        $this->insertUser = $insertUser;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModifiedUser()
    {
        return $this->modifiedUser;
    }

    /**
     * @param mixed $modifiedUser
     *
     * @return UserAwareTrait
     */
    public function setModifiedUser($modifiedUser)
    {
        $this->modifiedUser = $modifiedUser;

        return $this;
    }
}
 