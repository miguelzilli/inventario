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
     * @var \DateTime
     */
    private $fechaCompra;

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
     * @var string
     */
    private $garantia;

    /**
     * @var string
     */
    private $categoria;

    /**
     * @var decimal
     */
    private $costo;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $ubicacion;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var string
     */
    private $condicion;

    /**
     * @var string
     */
    private $codigoInventario;

    /**
     * @var string
     */
    private $codigoItem;


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
     * Set garantia
     *
     * @param string $garantia
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
     * @return string 
     */
    public function getGarantia()
    {
        return $this->garantia;
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     * @return Item
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return string 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set costo
     *
     * @param decimal $costo
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
     * @return decimal 
     */
    public function getCosto()
    {
        return $this->costo;
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
     * Set ubicacion
     *
     * @param string $ubicacion
     * @return Item
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    
        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string 
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Item
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set condicion
     *
     * @param string $condicion
     * @return Item
     */
    public function setCondicion($condicion)
    {
        $this->condicion = $condicion;
    
        return $this;
    }

    /**
     * Get condicion
     *
     * @return string 
     */
    public function getCondicion()
    {
        return $this->condicion;
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
}
