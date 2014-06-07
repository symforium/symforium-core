<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Plugin\CmsPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symforium\Core\Bundle\CoreBundle\Entity\Traits as CoreTraits;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="page")
 */
class Page
{
    use CoreTraits\UserAwareTrait, CoreTraits\DateAwareTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=256, nullable=false)
     */
    protected $title;

    /**
     * @var string $title
     *
     * @ORM\Column(name="url", type="string", length=256, nullable=false)
     */
    protected $url;

    /**
     * @var string $title
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    protected $content;

    /**
     * @var bool $published
     *
     * @ORM\Column(name="published", type="boolean", nullable=false)
     */
    protected $published = false;

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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return Page
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return Page
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * @return Page
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param bool $published
     *
     * @return Page
     */
    public function setPublished($published)
    {
        $this->published = (bool) $published;

        return $this;
    }

    /**
     * Slugs the page title
     *
     * @return string
     */
    public function getSlug()
    {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $this->getTitle());
        $text = trim($text, '-');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
 