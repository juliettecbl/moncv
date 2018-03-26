<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity
 * @ORM\Table(name="experience")
 * @ApiResource
 */
class Experience {
    
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
     * @ORM\Column(type="string")
     **/
    private $desc;
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

    function getDesc()
    {
        return $this->desc;
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
    
        function setDesc($desc)
    {
        $this->desc = $desc;
    }
}