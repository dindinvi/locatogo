<?php

namespace djepo\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Validator\ExecutionContextInterface;
//use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * location
 *
 * @ORM\Table(name="loca_location")
 * @ORM\Entity(repositoryClass="djepo\LocationBundle\Entity\locationRepository") 
 * @Assert\Callback(methods={"dateLocationValide"})
 * @ORM\HasLifecycleCallbacks()
 */

class location
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
     * @ORM\ManyToOne(targetEntity="djepo\LocationBundle\Entity\logement", inversedBy="locations")
    * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
*/
    private $logement;
    /**
* @ORM\OneToOne(targetEntity="djepo\LocationBundle\Entity\evaluation", mappedBy="location")
*@ORM\JoinColumn(nullable=true)
* @Assert\Valid()
*/
private $evaluation;

     //Le client peut disparaitre mais pas ses selections ou locations le contraire aussi est vrai
    
   /**
* @ORM\ManyToOne(targetEntity="djepo\UserBundle\Entity\User", cascade={"Persist"})
* @ORM\JoinColumn(nullable=false)
* @Assert\Valid()
*/
private $user;
 
    
    /**
     *
     * @ORM\OneToOne(targetEntity="djepo\UserBundle\Entity\facture", mappedBy="location", cascade={"Persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid()
     */
    protected $facture;
    /**
     * @var \DateTime
     *@Assert\DateTime()
     * @ORM\Column(name="dateLocation", type="date", nullable=false)
     */
    private $dateLocation;
  /**
     * @var \DateTime
     *@Assert\DateTime()
     * @ORM\Column(name="dateFinLocation", type="date", nullable=true)
     */
    private $dateFinLocation;
     
    
    /**
     * @var \DateTime
     *@Assert\DateTime()
     * @ORM\Column(name="dateUpdateLocation", type="date", nullable=true)
     */
    private $dateUpdateLocation;
    /**
     * @var string
     * @ORM\Column(name="token", type="string", length=255, nullable=true)
     */
    private $token;
    
    /**
     * @var \boolean
     *
     * @ORM\Column(name="valide", type="boolean", nullable=true)
     */
    private $valide;

    /**
     * @var integer
     *@Assert\Regex(pattern="/\d/", message="Votre montant  n'est pas valide.")
     * @ORM\Column(name="montantLoyer", type="integer", nullable=true)
     */
    private $montantLoyer;

    /**
     * @var string
     * @ORM\Column(name="typeLoyer", type="string", length=255, nullable=true)
     */
    private $typeLoyer;

    /**
     * @var integer
     * @ORM\Column(name="montantCharges", type="integer", nullable=true)
     */
    private $montantCharges;
    private $now;

public function __construct(){
     $this->valide = false;
     $this->now = new \DateTime();
     $this->dateFinLocation = new \DateTime();
     $this->dateLocation = new \DateTime();
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
     * Set dateLocation
     *
     * @param \DateTime $dateLocation
     * @return location
     */
    public function setDateLocation($dateLocation)
    {
        $this->dateLocation = $dateLocation;

        return $this;
    }

    /**
     * Get dateLocation
     *
     * @return \DateTime 
     */
    public function getDateLocation()
    {
        return $this->dateLocation;
    }
    
    
    
    

    /**
     * Set montantLoyer
     *
     * @param integer $montantLoyer
     * @return location
     */
    public function setMontantLoyer($montantLoyer)
    {
        $this->montantLoyer = $montantLoyer;

        return $this;
    }

    /**
     * Get montantLoyer
     *
     * @return integer 
     */
    public function getMontantLoyer()
    {
        return $this->montantLoyer;
    }

    /**
     * Set typeLoyer
     *
     * @param string $typeLoyer
     * @return location
     */
    public function setTypeLoyer($typeLoyer)
    {
        $this->typeLoyer = $typeLoyer;

        return $this;
    }

    /**
     * Get typeLoyer
     *
     * @return string 
     */
    public function getTypeLoyer()
    {
        return $this->typeLoyer;
    }

    /**
     * Set montantCharges
     *
     * @param integer $montantCharges
     * @return location
     */
    public function setMontantCharges($montantCharges)
    {
        $this->montantCharges = $montantCharges;

        return $this;
    }

    /**
     * Get montantCharges
     *
     * @return integer 
     */
    public function getMontantCharges()
    {
        return $this->montantCharges;
    }

   

    /**
     * Set logement
     *
     * @param \djepo\LocationBundle\Entity\logement $logement
     * @return location
     */
    public function setLogement(\djepo\LocationBundle\Entity\logement $logement)
    {
        $this->logement = $logement;

        return $this;
    }

    /**
     * Get logement
     *
     * @return \djepo\LocationBundle\Entity\logement 
     */
    public function getLogement()
    {
        return $this->logement;
    }

    /**
     * Set valide
     *
     * @param boolean $valide
     * @return location
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return boolean 
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set user
     *
     * @param \djepo\UserBundle\Entity\User $user
     * @return location
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
     * @return location
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

    /**
     * Set dateFinLocation
     *
     * @param \DateTime $dateFinLocation
     * @return location
     */
    public function setDateFinLocation($dateFinLocation)
    {
        $this->dateFinLocation = $dateFinLocation;

        return $this;
    }

    /**
     * Get dateFinLocation
     *
     * @return \DateTime 
     */
    public function getDateFinLocation()
    {
        return $this->dateFinLocation;
    }
 
    public function dateLocationValide(ExecutionContextInterface $context)
    {
        
         if ($this->dateLocation <= $this->now) {  
             $context->addViolationAt('dateLocation', 'La date de début doit être supérieur à la date du jour.', array(), null);}
       if ($this->dateFinLocation <= $this->now) {  
           $context->addViolationAt('dateFinLocation', 'La date de fin doit être supérieur à la date du jour.', array(), null);}
       
         if( !empty($this->dateFinLocation) && !empty($this->dateLocation)) {
               if ($this->dateFinLocation < $this->dateLocation) { 
                   $context->addViolationAt('dateLocation', 'La date de début doit être inférieur à la date de fin.', array(), null);}
            
        } else
            { // 2e argument : le message d'erreur
                $context->addViolationAt('dateLocation', 'Entrer une La date de début et une date de fin.', array(), null);
                
            }
    }
    
    /**
     * Set dateUpdateLocation
     *
     * @param \DateTime $dateUpdateLocation
     * @return location
     */
    public function setDateUpdateLocation($dateUpdateLocation)
    {
        $this->dateUpdateLocation = $dateUpdateLocation;

        return $this;
    }

    /**
     * Get dateUpdateLocation
     *
     * @return \DateTime 
     */
    public function getDateUpdateLocation()
    {
        return $this->dateUpdateLocation;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return location
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }
    
    public function getEvaluation()
    {
        return $this->evaluation;
    }
    
    public function setEvaluation(\djepo\LocationBundle\Entity\evaluation $evaluation)
    {
        $this->evaluation = $evaluation; 
        return $this;
    }
       
}
