<?php

namespace djepo\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * etatDesLieux
 *
 * @ORM\Table(name="loca_etatDesLieux")
 * @ORM\Entity(repositoryClass="djepo\LocationBundle\Entity\etatDesLieuxRepository")
 */
class etatDesLieux
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
* @ORM\ManyToOne(targetEntity="djepo\LocationBundle\Entity\location", cascade={"Persist"})
* @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
*/
private $location;


/**
     * @var \DateTime
     * @ORM\Column(name="dateVisite", type="datetime")
     * @Assert\Date() 
     */
    private $dateVisite;

    /**
     * @var string
     *
     * @ORM\Column(name="avisLocataire", type="text", nullable=true)
     */
    private $avisLocataire;


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
     * Set dateVisite
     *
     * @param \DateTime $dateVisite
     * @return etatDesLieux
     */
    public function setDateVisite($dateVisite)
    {
        $this->dateVisite = $dateVisite;

        return $this;
    }

    /**
     * Get dateVisite
     *
     * @return \DateTime 
     */
    public function getDateVisite()
    {
        return $this->dateVisite;
    }

    /**
     * Set avisLocataire
     *
     * @param string $avisLocataire
     * @return etatDesLieux
     */
    public function setAvisLocataire($avisLocataire)
    {
        $this->avisLocataire = $avisLocataire;

        return $this;
    }

    /**
     * Get avisLocataire
     *
     * @return string 
     */
    public function getAvisLocataire()
    {
        return $this->avisLocataire;
    }

    /**
     * Set location
     *
     * @param \djepo\LocationBundle\Entity\location $location
     * @return etatDesLieux
     */
    public function setLocation(\djepo\LocationBundle\Entity\location $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \djepo\LocationBundle\Entity\location 
     */
    public function getLocation()
    {
        return $this->location;
    }
}
