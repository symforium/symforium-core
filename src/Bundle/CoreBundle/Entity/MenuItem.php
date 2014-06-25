<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Bundle\CoreBundle\Entity;

use FOS\UserBundle\Entity\User as FOSUser;
use Doctrine\ORM\Mapping as ORM;
use Symforium\Bundle\CoreBundle\Entity\Traits\DateAwareTrait;
use Symforium\Bundle\CoreBundle\Entity\Traits\UserAwareTrait;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="menu_item")
 */
class MenuItem
{
    use DateAwareTrait, UserAwareTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $url
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $url;

    /**
     * @var string $display
     *
     * @ORM\Column(type="string", length=32)
     */
    protected $display;

    /**
     * @var string $title
     *
     * @ORM\Column(type="string", length=32)
     */
    protected $title;

    /**
     * @var bool $enabled
     *
     * @ORM\Column(type="boolean")
     */
    protected $enabled = true;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return MenuItem
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * @param string $display
     *
     * @return MenuItem
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return MenuItem
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     * @return MenuItem
     */
    public function setEnabled($enabled = true)
    {
        $this->enabled = $enabled;

        return $this;
    }
}
 