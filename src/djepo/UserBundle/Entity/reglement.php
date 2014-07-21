<?php

namespace djepo\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Prestation
 *
 * @ORM\Table(name="loca_reglement")
 * @ORM\Entity(repositoryClass="djepo\UserBundle\Entity\PrestationRepository")
 */
class reglement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
     //Le client peut disparaitre mais pas ses reglements ou locations le contraire aussi est vrai
   /**
* @ORM\ManyToOne(targetEntity="djepo\UserBundle\Entity\User", cascade={"Persist"})
* @ORM\JoinColumn(nullable=false)
* @Assert\Valid()
*/
private $user;

/**
     *
     * @ORM\OneToOne(targetEntity="djepo\UserBundle\Entity\facture", mappedBy="reglement", cascade={"Persist"})
     * @Assert\Valid()
     */
    private $facture;
    /**
     * @var \DateTime
     *@Assert\Date()
     * @ORM\Column(name="datePerception", type="date", nullable=false)
     */
    private $datePerception;

    /**
     * @var integer
     * @Assert\Regex(pattern="/\d/", message="Votre montant  n'est pas valide.")
     * @ORM\Column(name="montantPercu", type="integer", nullable=false)
     */
    private $montantPercu;

     
    /**
     * @var \DateTime
     * @Assert\Date()
     * @ORM\Column(name="dateVersement", type="date")
     */
    private $dateVersement;


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
     * Set datePerception
     *
     * @param \DateTime $datePerception
     * @return Prestation
     */
    public function setDatePerception($datePerception)
    {
        $this->datePerception = $datePerception;

        return $this;
    }

    /**
     * Get datePerception
     *
     * @return \DateTime 
     */
    public function getDatePerception()
    {
        return $this->datePerception;
    }

    /**
     * Set montantPercu
     *
     * @param integer $montantPercu
     * @return Prestation
     */
    public function setMontantPercu($montantPercu)
    {
        $this->montantPercu = $montantPercu;

        return $this;
    }

    /**
     * Get montantPercu
     *
     * @return integer 
     */
    public function getMontantPercu()
    {
        return $this->montantPercu;
    }

    

    /**
     * Set dateVersement
     *
     * @param \DateTime $dateVersement
     * @return Prestation
     */
    public function setDateVersement($dateVersement)
    {
        $this->dateVersement = $dateVersement;

        return $this;
    }

    /**
     * Get dateVersement
     *
     * @return \DateTime 
     */
    public function getDateVersement()
    {
        return $this->dateVersement;
    }


    /**
     * Set user
     *
     * @param \djepo\UserBundle\Entity\User $user
     * @return reglement
     */
    public function setUser(\djepo\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \djepo\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set facture
     *
     * @param \djepo\UserBundle\Entity\facture $facture
     * @return reglement
     */
    public function setFacture(\djepo\UserBundle\Entity\facture $facture = null)
    {
        $this->facture = $facture;

        return $this;
    }

    /**
     * Get facture
     *
     * @return \djepo\UserBundle\Entity\facture 
     */
    public function getFacture()
    {
        return $this->facture;
    }
}
