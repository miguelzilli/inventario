<?php

namespace G4\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Imagen
 */
class Imagen
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $ruta;

    /**
     * @var \G4\InventarioBundle\Entity\Item
     */
    private $item;


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
     * Set ruta
     *
     * @param string $ruta
     * @return Imagen
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    
        return $this;
    }

    /**
     * Get ruta
     *
     * @return string 
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set item
     *
     * @param \G4\InventarioBundle\Entity\Item $item
     * @return Imagen
     */
    public function setItem(\G4\InventarioBundle\Entity\Item $item = null)
    {
        $this->item = $item;
    
        return $this;
    }

    /**
     * Get item
     *
     * @return \G4\InventarioBundle\Entity\Item 
     */
    public function getItem()
    {
        return $this->item;
    }
}