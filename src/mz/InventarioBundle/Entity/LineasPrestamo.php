<?php

namespace mz\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * LineasPrestamo
 *
 * @ORM\Table(name="lineasprestamos")
 * @ORM\Entity
 */
class LineasPrestamo
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
     * @var \mz\InventarioBundle\Entity\Prestamo
     *
     * @ORM\ManyToOne(targetEntity="mz\InventarioBundle\Entity\Prestamo",  inversedBy="lineasPrestamos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prestamo_id", referencedColumnName="id")
     * })
     */
    private $prestamo;

   /**
     * @var \mz\InventarioBundle\Entity\Item
     *
     * @ORM\ManyToOne(targetEntity="mz\InventarioBundle\Entity\Item", inversedBy="lineasPrestamos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * })
     */
    private $item;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_devolucion", type="date", nullable=true)
     * @Assert\Date(message="Fecha inválida.")
     */
    private $fechaDevolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text")
     */
    private $observaciones;
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
     * Set prestamo
     *
     * @param string $prestamo
     * @return LineasPrestamo
     */
    public function setPrestamo($prestamo)
    {
        $this->prestamo = $prestamo;
    
        return $this;
    }

    /**
     * Get prestamo
     *
     * @return string 
     */
    public function getPrestamo()
    {
        return $this->prestamo;
    }

    /**
     * Set item
     *
     * @param string $item
     * @return LineasPrestamo
     */
    public function setItem($item)
    {
        $this->item = $item;
    
        return $this;
    }

    /**
     * Get item
     *
     * @return string 
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set fechaDevolucion
     *
     * @param string $fechaDevolucion
     * @return LineasPrestamo
     */
    public function setFechaDevolucion($fechaDevolucion)
    {
        $this->fechaDevolucion = $fechaDevolucion;
    
        return $this;
    }

    /**
     * Get fechaDevolucion
     *
     * @return string 
     */
    public function getFechaDevolucion()
    {
        return $this->fechaDevolucion;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return LineasPrestamo
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
}