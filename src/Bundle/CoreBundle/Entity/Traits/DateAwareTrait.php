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
trait DateAwareTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insert_date", type="datetime", nullable=false)
     */
    protected $insertDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_date", type="datetime", nullable=false)
     */
    protected $modifiedDate;

    /**
     * @param \DateTime $insertDate
     *
     * @return $this
     */
    public function setInsertDate($insertDate)
    {
        $this->insertDate = $insertDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getInsertDate()
    {
        return $this->insertDate;
    }

    /**
     * @param \DateTime $modifiedDate
     *
     * @return $this
     */
    public function setModifiedDate($modifiedDate)
    {
        $this->modifiedDate = $modifiedDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }
}
 