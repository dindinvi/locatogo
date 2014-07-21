<?php

namespace djepo\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * djepo\MainBundle\Entity\MotsCle
 *
 * @ORM\Table(name="loca_motscle")
 * @ORM\Entity(repositoryClass="djepo\MainBundle\Entity\MotsCleRepository")
 */
class MotsCle
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string $robot
     *
     * @ORM\Column(name="robot", type="string", length=100)
     */
    private $robot;

    /**
     * @var text $keyword
     *
     * @ORM\Column(name="keyword", type="text")
     */
    private $keyword;


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
     * Set titre
     *
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set robot
     *
     * @param string $robot
     */
    public function setRobot($robot)
    {
        $this->robot = $robot;
    }

    /**
     * Get robot
     *
     * @return string 
     */
    public function getRobot()
    {
        return $this->robot;
    }

    /**
     * Set keyword
     *
     * @param text $keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * Get keyword
     *
     * @return text 
     */
    public function getKeyword()
    {
        return $this->keyword;
    }
}