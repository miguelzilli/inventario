<?php

namespace mz\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use mz\InventarioBundle\Utils\Utils as Utils;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Condicion
 *
 * @ORM\Table(name="condiciones")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="mz\InventarioBundle\Entity\CondicionRepository")
 * @UniqueEntity(fields="nombre", message="Ya existe un registro con este nombre.")
 */
class Condicion
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
     * @Assert\NotBlank(message="Este campo no puede quedar en blanco.")
     */
    private $nombre;

    /**
     * @var string
     *
     */
    private $slug;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="mz\InventarioBundle\Entity\Item", mappedBy="condicion")
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
     * @return Condicion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        $this->setSlug($nombre);
    
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
     * @return Condicion
     */
    public function setSlug($slug)
    {
        $this->slug = Utils::slugify($slug);
    
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
     * @param \mz\InventarioBundle\Entity\Item $items
     * @return Condicion
     */
    public function addItem(\mz\InventarioBundle\Entity\Item $items)
    {
        $this->items[] = $items;
    
        return $this;
    }

    /**
     * Remove items
     *
     * @param \mz\InventarioBundle\Entity\Item $items
     */
    public function removeItem(\mz\InventarioBundle\Entity\Item $items)
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
}