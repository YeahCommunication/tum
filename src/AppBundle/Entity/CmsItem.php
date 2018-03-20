<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CmsItem.
 *
 * @ORM\Entity
 */
class CmsItem
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128)
     * @Assert\Type(type="string")
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(type="string")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Type(type="string")
     */
    private $content;

    /**
     * @var Cms
     *
     * @ORM\ManyToOne(targetEntity="Cms", inversedBy="items", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     */
    private $cms;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CmsItem
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return CmsItem
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
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
     * @return CmsItem
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return Cms
     */
    public function getCms()
    {
        return $this->cms;
    }

    /**
     * @param Cms $cms
     * @return CmsItem
     */
    public function setCms($cms)
    {
        $this->cms = $cms;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     * @return CmsItem
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

}
