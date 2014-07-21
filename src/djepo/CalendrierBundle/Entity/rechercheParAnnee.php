<?php
namespace djepo\CalendrierBundle\Entity;

//use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

 
class rechercheParAnnee  
{
   
    /**
     * @var \DateTime DateTime object of the event end date/time. 
     */
        protected $annee;
    
 
     public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    
    public function getAnnee()
    {
        return $this->annee;
    }
    
   
}