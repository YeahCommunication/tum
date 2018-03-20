<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Configuration.
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CmsRepository")
 *
 * @author Nath
 */
final class Cms
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, unique=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, unique=true)
     */
    protected $alias;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    protected $value;

    /**
     * @var ArrayCollection CmsItem
     *
     * @ORM\OneToMany(targetEntity="CmsItem", mappedBy="cms", cascade={"persist"}, fetch="EAGER")
     */
    protected $items;

    /**
     * Cms constructor.
     */
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * Get $id.
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
     * @return Cms
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return Cms
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return array
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param array $value
     * @return Cms
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param ArrayCollection $items
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @param CmsItem $cmsItem
     */
    public function addItem(CmsItem $cmsItem)
    {
        $cmsItem->setCms($this);

        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->items->contains($cmsItem)) {
            $this->items->add($cmsItem);
        }
    }

    public function __toString()
    {
        return $this->name;
    }
}
