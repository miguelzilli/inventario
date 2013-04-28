<?php

namespace mz\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="items")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Item
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=255)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=255)
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(name="sn", type="string", length=255)
     */
    private $sn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_compra", type="date")
     */
    private $fechaCompra;

    /**
     * @var float
     *
     * @ORM\Column(name="costo", type="decimal", scale=2)
     */
    private $costo;

    /**
     * @var integer
     *
     * @ORM\Column(name="garantia", type="integer")
     */
    private $garantia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, unique=true)
     */
    private $codigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="created_by", type="string", length=255)
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="updated_by", type="string")
     */
    private $updatedBy;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="mz\InventarioBundle\Entity\Imagen", mappedBy="item")
     */
    private $imagenes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="mz\InventarioBundle\Entity\Prestamo", mappedBy="item")
     */
    private $prestamos;

    /**
     * @var \mz\InventarioBundle\Entity\Categoria
     *
     * @ORM\ManyToOne(targetEntity="mz\InventarioBundle\Entity\Categoria", inversedBy="items")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;

    /**
     * @var \mz\InventarioBundle\Entity\Condicion
     *
     * @ORM\ManyToOne(targetEntity="mz\InventarioBundle\Entity\Condicion", inversedBy="items")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="condicion_id", referencedColumnName="id")
     * })
     */
    private $condicion;

    /**
     * @var \mz\InventarioBundle\Entity\Estado
     *
     * @ORM\ManyToOne(targetEntity="mz\InventarioBundle\Entity\Estado", inversedBy="items")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_id", referencedColumnName="id")
     * })
     */
    private $estado;

    /**
     * @var \mz\InventarioBundle\Entity\Ubicacion
     *
     * @ORM\ManyToOne(targetEntity="mz\InventarioBundle\Entity\Ubicacion", inversedBy="items")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ubicacion_id", referencedColumnName="id")
     * })
     */
    private $ubicacion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->imagenes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->prestamos = new \Doctrine\Common\Collections\ArrayCollection();

        $now=new \DateTime();
        $now=new \DateTime();
        $this->setCreatedAt($now);
        $this->setCreatedBy('Juan Perez');

        $this->setUpdatedAt($now);
        $this->setUpdatedBy('Juan Perez');
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
     * Set codigo
     *
     * @param string $codigo
     * @return Item
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
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
     * @param \mz\InventarioBundle\Entity\Imagen $imagenes
     * @return Item
     */
    public function addImagene(\mz\InventarioBundle\Entity\Imagen $imagenes)
    {
        $this->imagenes[] = $imagenes;
    
        return $this;
    }

    /**
     * Remove imagenes
     *
     * @param \mz\InventarioBundle\Entity\Imagen $imagenes
     */
    public function removeImagene(\mz\InventarioBundle\Entity\Imagen $imagenes)
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
     * @param \mz\InventarioBundle\Entity\Prestamo $prestamos
     * @return Item
     */
    public function addPrestamo(\mz\InventarioBundle\Entity\Prestamo $prestamos)
    {
        $this->prestamos[] = $prestamos;
    
        return $this;
    }

    /**
     * Remove prestamos
     *
     * @param \mz\InventarioBundle\Entity\Prestamo $prestamos
     */
    public function removePrestamo(\mz\InventarioBundle\Entity\Prestamo $prestamos)
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
     * @param \mz\InventarioBundle\Entity\Categoria $categoria
     * @return Item
     */
    public function setCategoria(\mz\InventarioBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return \mz\InventarioBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set condicion
     *
     * @param \mz\InventarioBundle\Entity\Condicion $condicion
     * @return Item
     */
    public function setCondicion(\mz\InventarioBundle\Entity\Condicion $condicion = null)
    {
        $this->condicion = $condicion;
    
        return $this;
    }

    /**
     * Get condicion
     *
     * @return \mz\InventarioBundle\Entity\Condicion 
     */
    public function getCondicion()
    {
        return $this->condicion;
    }

    /**
     * Set estado
     *
     * @param \mz\InventarioBundle\Entity\Estado $estado
     * @return Item
     */
    public function setEstado(\mz\InventarioBundle\Entity\Estado $estado = null)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return \mz\InventarioBundle\Entity\Estado 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set ubicacion
     *
     * @param \mz\InventarioBundle\Entity\Ubicacion $ubicacion
     * @return Item
     */
    public function setUbicacion(\mz\InventarioBundle\Entity\Ubicacion $ubicacion = null)
    {
        $this->ubicacion = $ubicacion;
    
        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return \mz\InventarioBundle\Entity\Ubicacion 
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue() {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedByValue() {
        $this->setUpdatedBy('Juan Perez');
    }
}