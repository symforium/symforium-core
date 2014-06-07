<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Bundle\CoreBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 *
 * @ORM\MappedSuperclass
 */
trait UserAwareTrait
{
    /**
     * @var \Symforium\Bundle\CoreBundle\Entity\User $insertUser
     *
     * @ORM\ManyToOne(targetEntity="\Symforium\Bundle\CoreBundle\Entity\User")
     * @ORM\JoinColumn(name="insert_user_id", referencedColumnName="id", nullable=false)
     */
    protected $insertUser;

    /**
     * @var \Symforium\Bundle\CoreBundle\Entity\User $modifiedUser
     *
     * @ORM\ManyToOne(targetEntity="\Symforium\Bundle\CoreBundle\Entity\User")
     * @ORM\JoinColumn(name="modified_user_id", referencedColumnName="id", nullable=false)
     */
    protected $modifiedUser;

    /**
     * @return \Symforium\Bundle\CoreBundle\Entity\User
     */
    public function getInsertUser()
    {
        return $this->insertUser;
    }

    /**
     * @param \Symforium\Bundle\CoreBundle\Entity\User $insertUser
     *
     * @return $this
     */
    public function setInsertUser($insertUser)
    {
        $this->insertUser = $insertUser;

        return $this;
    }

    /**
     * @return \Symforium\Bundle\CoreBundle\Entity\User
     */
    public function getModifiedUser()
    {
        return $this->modifiedUser;
    }

    /**
     * @param mixed $modifiedUser
     *
     * @return $this
     */
    public function setModifiedUser($modifiedUser)
    {
        $this->modifiedUser = $modifiedUser;

        return $this;
    }
}
 