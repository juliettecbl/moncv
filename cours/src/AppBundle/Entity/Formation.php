<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity
 * @ORM\Table(name="formation")
 * @ApiResource
 */
class Formation
{
    
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

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    public function getDateFin()
    {
        return $this->dateFin;
    }

    public function getLieu()
    {
        return $this->lieu;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }
}
