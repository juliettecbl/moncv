<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity
 * @ORM\Table(name="formation")
 * @ApiResource
 */
class Formation {
    
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue 
     **/
    private $id;
    /** 
     * @ORM\Column(type="string")
     **/
    private $name;
    /** 
     * @ORM\Column(type="date")
     **/
    private $dateDebut;
    /** 
     * @ORM\Column(type="date")
     **/
    private $dateFin;
    /** 
     * @ORM\Column(type="string")
     **/
    private $lieu;

    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->name;
    }

    function getDateDebut()
    {
        return $this->dateDebut;
    }

    function getDateFin()
    {
        return $this->dateFin;
    }

    function getLieu()
    {
        return $this->lieu;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }
}
