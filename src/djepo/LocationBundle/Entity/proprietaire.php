<?php

namespace djepo\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 

/**
 * proprietaire
 *
 * @ORM\Table(name="loca_proprietaire")
 * @ORM\Entity(repositoryClass="djepo\LocationBundle\Entity\proprietaireRepository") 
 */
class proprietaire
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
* @ORM\OneToOne(targetEntity="djepo\UserBundle\Entity\Personne",  inversedBy="proprietaire", cascade={"Persist","Remove"})
* @ORM\JoinColumn(nullable=false)
* @Assert\Valid()
*/
private $personne;
 
   


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
     * Set user
     *
     * @param \djepo\UserBundle\Entity\Personne $personne
     * @return proprietaire
     */
    public function setPersonne(\djepo\UserBundle\Entity\Personne $personne)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get user
     *
     * @return \djepo\UserBundle\Entity\Personne
     */
    public function getPersonne()
    {
        return $this->personne;
    }
    
    
    
}
