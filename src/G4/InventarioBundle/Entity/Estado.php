<?php

namespace G4\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use G4\InventarioBundle\Utils\Utils as Utils;

/**
 * Estado
 *
 * @ORM\Table(name="estados")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Estado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="G4\InventarioBundle\Entity\Item", mappedBy="estado")
     */
    private $items;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Estado
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Estado
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add items
     *
     * @param \G4\InventarioBundle\Entity\Item $items
     * @return Estado
     */
    public function addItem(\G4\InventarioBundle\Entity\Item $items)
    {
        $this->items[] = $items;
    
        return $this;
    }

    /**
     * Remove items
     *
     * @param \G4\InventarioBundle\Entity\Item $items
     */
    public function removeItem(\G4\InventarioBundle\Entity\Item $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }

    public function __toString() {
        return $this->getNombre();
    }
    /**
     * @ORM\PrePersist
     */
    public function setSlugValue() {
        if (!$this->getSlug()) {
            $this->setSlug(Utils::slugify($this->getNombre()));
        }
    }
}