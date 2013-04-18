<?php

namespace G4\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prestamo
 */
class Prestamo
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $apellido;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $dni;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var \DateTime
     */
    private $fechaDevolucion;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $createdBy;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $updatedBy;

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
     * Set apellido
     *
     * @param string $apellido
     * @return Prestamo
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    
        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Prestamo
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
     * Set dni
     *
     * @param string $dni
     * @return Prestamo
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    
        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Prestamo
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set fechaDevolucion
     *
     * @param \DateTime $fechaDevolucion
     * @return Prestamo
     */
    public function setFechaDevolucion($fechaDevolucion)
    {
        $this->fechaDevolucion = $fechaDevolucion;
    
        return $this;
    }

    /**
     * Get fechaDevolucion
     *
     * @return \DateTime 
     */
    public function getFechaDevolucion()
    {
        return $this->fechaDevolucion;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Prestamo
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    
        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Prestamo
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return Prestamo
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    
        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Prestamo
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedBy
     *
     * @param string $updatedBy
     * @return Prestamo
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
    
        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return string 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set item
     *
     * @param \G4\InventarioBundle\Entity\Item $item
     * @return Prestamo
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

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if(!$this->getCreatedAt())
        {
            $this->createdAt = new \DateTime();
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedByValue()
    {
        if(!$this->getCreatedBy())
        {
        //CHANGE_THIS
            $this->createdBy = 'Juan Perez';
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedByValue()
    {
        //CHANGE_THIS
        $this->updatedBy = 'Juan Perez';
    }
}