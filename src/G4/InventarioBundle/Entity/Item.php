<?php

namespace G4\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 */
class Item
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $marca;

    /**
     * @var string
     */
    private $modelo;

    /**
     * @var string
     */
    private $sn;

    /**
     * @var \DateTime
     */
    private $fechaCompra;

    /**
     * @var float
     */
    private $costo;

    /**
     * @var integer
     */
    private $garantia;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $codigoInventario;

    /**
     * @var string
     */
    private $codigoItem;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $imagenes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $prestamos;

    /**
     * @var \G4\InventarioBundle\Entity\Categoria
     */
    private $categoria;

    /**
     * @var \G4\InventarioBundle\Entity\Condicion
     */
    private $condicion;

    /**
     * @var \G4\InventarioBundle\Entity\Estado
     */
    private $estado;

    /**
     * @var \G4\InventarioBundle\Entity\Ubicacion
     */
    private $ubicacion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->imagenes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->prestamos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Item
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
     * Set marca
     *
     * @param string $marca
     * @return Item
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    
        return $this;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     * @return Item
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    
        return $this;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set sn
     *
     * @param string $sn
     * @return Item
     */
    public function setSn($sn)
    {
        $this->sn = $sn;
    
        return $this;
    }

    /**
     * Get sn
     *
     * @return string 
     */
    public function getSn()
    {
        return $this->sn;
    }

    /**
     * Set fechaCompra
     *
     * @param \DateTime $fechaCompra
     * @return Item
     */
    public function setFechaCompra($fechaCompra)
    {
        $this->fechaCompra = $fechaCompra;
    
        return $this;
    }

    /**
     * Get fechaCompra
     *
     * @return \DateTime 
     */
    public function getFechaCompra()
    {
        return $this->fechaCompra;
    }

    /**
     * Set costo
     *
     * @param float $costo
     * @return Item
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;
    
        return $this;
    }

    /**
     * Get costo
     *
     * @return float 
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * Set garantia
     *
     * @param integer $garantia
     * @return Item
     */
    public function setGarantia($garantia)
    {
        $this->garantia = $garantia;
    
        return $this;
    }

    /**
     * Get garantia
     *
     * @return integer 
     */
    public function getGarantia()
    {
        return $this->garantia;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Item
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set codigoInventario
     *
     * @param string $codigoInventario
     * @return Item
     */
    public function setCodigoInventario($codigoInventario)
    {
        $this->codigoInventario = $codigoInventario;
    
        return $this;
    }

    /**
     * Get codigoInventario
     *
     * @return string 
     */
    public function getCodigoInventario()
    {
        return $this->codigoInventario;
    }

    /**
     * Set codigoItem
     *
     * @param string $codigoItem
     * @return Item
     */
    public function setCodigoItem($codigoItem)
    {
        $this->codigoItem = $codigoItem;
    
        return $this;
    }

    /**
     * Get codigoItem
     *
     * @return string 
     */
    public function getCodigoItem()
    {
        return $this->codigoItem;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Item
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
     * @return Item
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
     * @return Item
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
     * @return Item
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
     * Add imagenes
     *
     * @param \G4\InventarioBundle\Entity\Imagen $imagenes
     * @return Item
     */
    public function addImagene(\G4\InventarioBundle\Entity\Imagen $imagenes)
    {
        $this->imagenes[] = $imagenes;
    
        return $this;
    }

    /**
     * Remove imagenes
     *
     * @param \G4\InventarioBundle\Entity\Imagen $imagenes
     */
    public function removeImagene(\G4\InventarioBundle\Entity\Imagen $imagenes)
    {
        $this->imagenes->removeElement($imagenes);
    }

    /**
     * Get imagenes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImagenes()
    {
        return $this->imagenes;
    }

    /**
     * Add prestamos
     *
     * @param \G4\InventarioBundle\Entity\Prestamo $prestamos
     * @return Item
     */
    public function addPrestamo(\G4\InventarioBundle\Entity\Prestamo $prestamos)
    {
        $this->prestamos[] = $prestamos;
    
        return $this;
    }

    /**
     * Remove prestamos
     *
     * @param \G4\InventarioBundle\Entity\Prestamo $prestamos
     */
    public function removePrestamo(\G4\InventarioBundle\Entity\Prestamo $prestamos)
    {
        $this->prestamos->removeElement($prestamos);
    }

    /**
     * Get prestamos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrestamos()
    {
        return $this->prestamos;
    }

    /**
     * Set categoria
     *
     * @param \G4\InventarioBundle\Entity\Categoria $categoria
     * @return Item
     */
    public function setCategoria(\G4\InventarioBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return \G4\InventarioBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set condicion
     *
     * @param \G4\InventarioBundle\Entity\Condicion $condicion
     * @return Item
     */
    public function setCondicion(\G4\InventarioBundle\Entity\Condicion $condicion = null)
    {
        $this->condicion = $condicion;
    
        return $this;
    }

    /**
     * Get condicion
     *
     * @return \G4\InventarioBundle\Entity\Condicion 
     */
    public function getCondicion()
    {
        return $this->condicion;
    }

    /**
     * Set estado
     *
     * @param \G4\InventarioBundle\Entity\Estado $estado
     * @return Item
     */
    public function setEstado(\G4\InventarioBundle\Entity\Estado $estado = null)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return \G4\InventarioBundle\Entity\Estado 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set ubicacion
     *
     * @param \G4\InventarioBundle\Entity\Ubicacion $ubicacion
     * @return Item
     */
    public function setUbicacion(\G4\InventarioBundle\Entity\Ubicacion $ubicacion = null)
    {
        $this->ubicacion = $ubicacion;
    
        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return \G4\InventarioBundle\Entity\Ubicacion 
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
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
     * @ORM\PrePersist
     */
    public function setCodigoItemValue()
    {
        if(!$this->getCodigoItem())
        {
        //CHANGE_THIS
            $this->codigoItem = hash('md5',rand());
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