<?php

namespace djepo\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;
/**
 * search
 * @Assert\Callback(methods={"dateLocationValide"})
 * @ORM\HasLifecycleCallbacks()
 */
class search
{
    /**
     * @var integer
     */
    private $id;
      /**
     * @var integer
     *@Assert\Regex(pattern="/\d/", message="Votre montant  n'est pas valide.") 
     */
    private $montantLoyer;
    
     /**
     * @var \DateTime
     *@Assert\DateTime()
     */
    private $dateLocation;
     /**
     * @var \DateTime
     *@Assert\DateTime()
     */
    private $dateFinLocation;
   
     /**
     * @var string $nomVille 
     */
    private $nomVille;
    
    private $now;
    public function __construct() {
        $this->now = new \DateTime();
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
        
         if( !empty($this->dateLocation)) {
                     if ($this->dateLocation <= $this->now) {  
                      $context->addViolationAt('dateLocation', 'La date de début doit être supérieur à la date du jour.', array(), null);
                     }
         }
          if( !empty($this->dateFinLocation)) {
                if ($this->dateFinLocation <= $this->now) {  
                  $context->addViolationAt('dateFinLocation', 'La date de fin doit être supérieur à la date du jour.', array(), null);
                }
         }
       
         if( !empty($this->dateFinLocation) && !empty($this->dateLocation)) {
               if ($this->dateFinLocation < $this->dateLocation) { 
                   $context->addViolationAt('dateLocation', 'La date de début doit être inférieur à la date de fin.', array(), null);
                   
               }
            
        } 
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
     * Set nomVille
     *
     * @param string $nomVille
     */
    public function setNomVille($nomVille)
    {
        $this->nomVille = $nomVille;
    }

    /**
     * Get nomVille
     *
     * @return string 
     */
    public function getNomVille()
    {
        return $this->nomVille;
    }
    
}
