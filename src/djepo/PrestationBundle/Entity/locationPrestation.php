<?php

namespace djepo\PrestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * locationPrestation
 *
 * @ORM\Table(name="loca_locationPrestation")
 * @ORM\Entity(repositoryClass="djepo\PrestationBundle\Entity\locationPrestationRepository")
 */
class locationPrestation
{
    
    /**
     *@ORM\Id
    * @ORM\ManyToOne(targetEntity="djepo\LocationBundle\Entity\location", cascade={"Persist"})
    * @Assert\Valid()
    */
    private $location;
    
    /**
    * @ORM\Id
    * @ORM\ManyToOne(targetEntity="djepo\PrestationBundle\Entity\prestation", cascade={"Persist"}) 
     * @Assert\Valid()
     */
    private $prestation;
    
    /**
     * @var \DateTime
     * @Assert\Date()
     * 
     * @ORM\Column(name="dateDepartPrestation", type="datetime", nullable=false)
     */
    private $dateDepartPrestation;

    /**
     * @var \DateTime
     *@Assert\Date()
     * @ORM\Column(name="dateFinPrestation", type="datetime", nullable=false)
     */
    private $dateFinPrestation;

    /**
     * @var integer
     * @Assert\Regex(pattern="/\d/", message="Votre montant n'est pas valide.")
     * @ORM\Column(name="montant", type="integer")
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

 
    /**
     * Set dateDepartPrestation
     *
     * @param \DateTime $dateDepartPrestation
     * @return locationPrestation
     */
    public function setDateDepartPrestation($dateDepartPrestation)
    {
        $this->dateDepartPrestation = $dateDepartPrestation;

        return $this;
    }

    /**
     * Get dateDepartPrestation
     *
     * @return \DateTime 
     */
    public function getDateDepartPrestation()
    {
        return $this->dateDepartPrestation;
    }

    /**
     * Set dateFinPrestation
     *
     * @param \DateTime $dateFinPrestation
     * @return locationPrestation
     */
    public function setDateFinPrestation($dateFinPrestation)
    {
        $this->dateFinPrestation = $dateFinPrestation;

        return $this;
    }

    /**
     * Get dateFinPrestation
     *
     * @return \DateTime 
     */
    public function getDateFinPrestation()
    {
        return $this->dateFinPrestation;
    }

    /**
     * Set montant
     *
     * @param integer $montant
     * @return locationPrestation
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return integer 
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return locationPrestation
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set location
     *
     * @param \djepo\LocationBundle\Entity\location $location
     * @return locationPrestation
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

    /**
     * Set prestation
     *
     * @param \djepo\PrestationBundle\Entity\prestation $prestation
     * @return locationPrestation
     */
    public function setPrestation(\djepo\PrestationBundle\Entity\prestation $prestation)
    {
        $this->prestation = $prestation;

        return $this;
    }

    /**
     * Get prestation
     *
     * @return \djepo\PrestationBundle\Entity\prestation 
     */
    public function getPrestation()
    {
        return $this->prestation;
    }
}
