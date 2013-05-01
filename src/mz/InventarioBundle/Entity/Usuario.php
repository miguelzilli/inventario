<?php

namespace mz\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Validator\Constraint as SecurityAssert;

/**
 * Usuario
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity
 * @UniqueEntity(fields="username", message="Ya existe un registro con este nombre.")
 * @UniqueEntity(fields="email", message="Ya existe un registro con este nombre.")
 */
class Usuario
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
     * @ORM\Column(name="apellido", type="string", length=255)
     * @Assert\NotBlank(message="Este campo no puede quedar en blanco.")
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank(message="Este campo no puede quedar en blanco.")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email(message = "La dirección: '{{ value }}' no es válida.")
     * @Assert\NotBlank(message="Este campo no puede quedar en blanco.")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Este campo no puede quedar en blanco.")
     * @Assert\Length(min = "6", minMessage = "Ingrese al menos {{ limit }} caracteres.")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotBlank(message="Este campo no puede quedar en blanco.")
     * @Assert\Length(min = "6", minMessage = "Ingrese al menos {{ limit }} caracteres.")
     */
    private $password;

    /**
     * @var string
     * 
     * @SecurityAssert\UserPassword(message = "Contraseña incorrecta.")
     * @Assert\NotBlank(message="Este campo no puede quedar en blanco.")
     */
    private $oldPassword;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_enabled", type="boolean")
     * @Assert\Type(type="bool", message="El valor {{ value }} no es del tipo {{ type }}.")
     */
    private $isEnabled = true;

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
     * @return Usuario
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
     * @return Usuario
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
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set isEnabled
     *
     * @param boolean $isEnabled
     * @return Usuario
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
    
        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return boolean 
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }
}