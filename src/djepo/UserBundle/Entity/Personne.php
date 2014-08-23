<?php

namespace djepo\UserBundle\Entity;

 
 use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * djepo\UserBundle\Entity\Personne
 *
 * @ORM\Table(name="loca_personne")
 * @ORM\Entity(repositoryClass="djepo\UserBundle\Entity\PersonneRepository")
 */
class Personne
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
      /**
     *  @ORM\ManyToOne(targetEntity="djepo\UserBundle\Entity\Adresse", cascade={"Persist","Remove"})
     *  @ORM\JoinColumn(nullable=true)
     *  @Assert\Valid()
     */
    private $adresse;
   /**
     *
     * @ORM\OneToOne(targetEntity="djepo\UserBundle\Entity\User", mappedBy="personne", cascade={"Persist","Remove"})
     * @Assert\Valid()
     */
    private $user;
    
       /**
        * @ORM\OneToOne(targetEntity="djepo\LocationBundle\Entity\proprietaire",mappedBy="personne", cascade={"Persist","Remove"})
        * @Assert\Valid()
        */
        private $proprietaire;
        
    /**
     * @var string
     * @ORM\Column(name="firstname",type="string", nullable=true)
     */
    private $firstname;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", nullable=true)
     */
   private $lastname;

      
    /**
     * @var datetime $dateN
     *
     * @ORM\Column(name="dateN", type="date", nullable=true)
     * @Assert\DateTime()
     */
    private  $dateN;

    /**
     * @var string $typeEntite
     *
     * @ORM\Column(name="typeEntite", type="string", length=12, nullable=true)
     * @Assert\NotBlank(message="Veuillez selectionner une option ")
     */
    private $typeEntite;

    /**
     * @var string $telFixe
     * @ORM\Column(name="telFixe", type="string", length=255, nullable=true)
     *  @Assert\Regex(pattern="/\d/", message="Votre t�l�phone fixe n'est pas valide.")
     */
    private $telFixe;

    /**
     * @var string $telPortable
     * @ORM\Column(name="telPortable", type="string", length=255, nullable=true)     
     * @Assert\Regex(pattern="/\d/", message="Votre t�l�phone portable n'est pas valide.")
     */
    private $telPortable;
    
     
    /**
     * @var string $fax     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     * @Assert\Regex(pattern="/\d/", message="Votre fax n'est pas valide.")
     */
    private $fax;
    

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
     * Set dateN
     *
     * @param \DateTime $dateN
     * @return Personne
     */
    public function setDateN($dateN)
    {
        $this->dateN = $dateN;

        return $this;
    }

    /**
     * Get dateN
     *
     * @return \DateTime 
     */
    public function getDateN()
    {
        return $this->dateN;
    }

    /**
     * Set typeEntite
     *
     * @param string $typeEntite
     * @return Personne
     */
    public function setTypeEntite($typeEntite)
    {
        $this->typeEntite = $typeEntite;

        return $this;
    }

    /**
     * Get typeEntite
     *
     * @return string 
     */
    public function getTypeEntite()
    {
        return $this->typeEntite;
    }

    /**
     * Set telFixe
     *
     * @param string $telFixe
     * @return Personne
     */
    public function setTelFixe($telFixe)
    {
        $this->telFixe = $telFixe;

        return $this;
    }

    /**
     * Get telFixe
     *
     * @return string 
     */
    public function getTelFixe()
    {
        return $this->telFixe;
    }

    /**
     * Set telPortable
     *
     * @param string $telPortable
     * @return Personne
     */
    public function setTelPortable($telPortable)
    {
        $this->telPortable = $telPortable;

        return $this;
    }

    /**
     * Get telPortable
     *
     * @return string 
     */
    public function getTelPortable()
    {
        return $this->telPortable;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Personne
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set adresse
     *
     * @param \djepo\UserBundle\Entity\Adresse $adresse
     * @return Personne
     */
    public function setAdresse(\djepo\UserBundle\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \djepo\UserBundle\Entity\Adresse 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set user
     *
     * @param \djepo\UserBundle\Entity\User $user
     * @return Personne
     */
    public function setUser(\djepo\UserBundle\Entity\User $user = null)
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
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname=null)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname=null)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get the full name of the user (first + last name)
     * @return string
     */
    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastname();
    }
    
    public function getMailSender()
    {
        return $this->getUser()->getEmail();
    }
    
    /**
     * Set proprietaire
     *
     * @param \djepo\LocationBundle\Entity\proprietaire $proprietaire
     * @return propriete
     */
    public function setProprietaire(\djepo\LocationBundle\Entity\proprietaire $proprietaire=null)
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    /**
     * Get proprietaire
     *
     * @return \djepo\LocationBundle\Entity\proprietaire 
     */
    public function getProprietaire()
    {
        return $this->proprietaire;
    }
}
