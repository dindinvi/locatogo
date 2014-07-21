<?php

namespace djepo\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
//use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * logement
 *
 * @ORM\Table(name="loca_logement")
 * @ORM\Entity(repositoryClass="djepo\LocationBundle\Entity\logementRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class logement
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
* @ORM\ManyToOne(targetEntity="djepo\LocationBundle\Entity\propriete", cascade={"Persist"})
* @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
*/
private $propriete;

    /**
* @ORM\ManyToOne(targetEntity="djepo\LocationBundle\Entity\image", cascade={"Persist","remove"})
* @ORM\JoinColumn(nullable=true)
*@Assert\Valid() 
*/
private $image;

/**
* @ORM\OneToMany(targetEntity="djepo\LocationBundle\Entity\evaluation", mappedBy="logement")
* @Assert\Valid()
*/
private $evaluations;

    /**
     * @var string
     * 
     * @Assert\NotBlank(message="Veuillez entrer un titre")
     * @Assert\MinLength(limit=10, message="Veuillez entrer un titre de plus de {{ limit  }} caracteres")
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var integer
     *  @Assert\Min(1) 
     * @ORM\Column(name="nombrePiece", type="integer", nullable=false)
     */
    private $nombrePiece;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez choisir un type")
     * @ORM\Column(name="typeImmeuble", type="string", length=255, nullable=false)
     */
    private $typeImmeuble;

    /**
     * @var integer
     * @Assert\NotBlank(message="Veuillez entrer une surface")
     * @ORM\Column(name="surface", type="integer", nullable=true)
     */
    private $surface;

    /**
     * @var integer
     * @Assert\NotBlank(message="Veuillez entrer le nombre de sejour")
     * @ORM\Column(name="sejour", type="integer", nullable=true)
     */
    private $sejour;
    /**
     * @var integer
     * @Assert\NotBlank(message="Veuillez entrer le nombre de salle de bain")
     * @ORM\Column(name="sdd", type="integer", nullable=true)
     */
    private $sbb;
    
    /**
     * @var integer
     * @Assert\NotBlank(message="Veuillez entrer le nombre de chambre")
     * @ORM\Column(name="chambre", type="integer", nullable=false)
     */
    private $chambre;
    
    /**
     * @var integer
     * @Assert\NotBlank(message="Veuillez entrer le nombre de cuisine")
     * @ORM\Column(name="cuisine", type="integer", nullable=false)
     */
    private $cuisine;
    /**
     * @var integer
     * @Assert\NotBlank(message="Veuillez entrer un montant pour la location")
     * @ORM\Column(name="montantloyer", type="integer", nullable=true)
     */
    private $montantloyer;
    
    /**
     * @var string
     *
     * @ORM\Column(name="transport", type="string", length=255, nullable=true)
     */
    private $transport;

 /**
     * @var \DateTime
     *@Assert\Date()
     * @ORM\Column(name="dateAnnonce", type="date", nullable=false)
     */
     private $dateAnnonce;
     
    
    
   /**
     * @var integer 
     * @ORM\Column(name="nbEvaluations", type="integer", nullable=true)
     */
    private $nbEvaluations;
    
  /**
     * @var \DateTime
     *@Assert\Date()
     * @ORM\Column(name="dateFinAnnonce", type="date", nullable=true)
     */
    private $dateFinAnnonce;
    
    /**
     * @var \DateTime
     *@Assert\Date()
     * @ORM\Column(name="dateUpdateAnnonce", type="date", nullable=true)
     */
    private $dateUpdateAnnonce;
    
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
     * Set libelle
     *
     * @param string $libelle
     * @return loca_logement
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set nombrePiece
     *
     * @param integer $nombrePiece
     * @return loca_logement
     */
    public function setNombrePiece($nombrePiece)
    {
        $this->nombrePiece = $nombrePiece;

        return $this;
    }

    /**
     * Get nombrePiece
     *
     * @return integer 
     */
    public function getNombrePiece()
    {
        return $this->nombrePiece;
    }

    /**
     * Set typeImmeuble
     *
     * @param string $typeImmeuble
     * @return loca_logement
     */
    public function setTypeImmeuble($typeImmeuble)
    {
        $this->typeImmeuble = $typeImmeuble;

        return $this;
    }

    /**
     * Get typeImmeuble
     *
     * @return string 
     */
    public function getTypeImmeuble()
    {
        return $this->typeImmeuble;
    }

    /**
     * Set surface
     *
     * @param integer $surface
     * @return loca_logement
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * Get surface
     *
     * @return integer 
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Set transport
     *
     * @param string $transport
     * @return loca_logement
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;

        return $this;
    }
 public function getMontantloyer()
    {
        return $this->montantloyer;
    }

public function setMontantloyer($montantloyer)
    {
    $this->montantloyer = $montantloyer;
       return $this;
    }
    
    /**
     * Get transport
     *
     * @return string 
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set propriete
     *
     * @param \djepo\LocationBundle\Entity\propriete $propriete
     * @return logement
     */
    public function setPropriete(\djepo\LocationBundle\Entity\propriete $propriete)
    {
        $this->propriete = $propriete;

        return $this;
    }

    /**
     * Get propriete
     *
     * @return \djepo\LocationBundle\Entity\propriete 
     */
    public function getPropriete()
    {
        return $this->propriete;
    }

    /**
     * Set sejour
     *
     * @param integer $sejour
     * @return logement
     */
    public function setSejour($sejour)
    {
        $this->sejour = $sejour;

        return $this;
    }

    /**
     * Get sejour
     *
     * @return integer 
     */
    public function getSejour()
    {
        return $this->sejour;
    }

    /**
     * Set sbb
     *
     * @param integer $sbb
     * @return logement
     */
    public function setSbb($sbb)
    {
        $this->sbb = $sbb;

        return $this;
    }

    /**
     * Get sbb
     *
     * @return integer 
     */
    public function getSbb()
    {
        return $this->sbb;
    }

    /**
     * Set chambre
     *
     * @param integer $chambre
     * @return logement
     */
    public function setChambre($chambre)
    {
        $this->chambre = $chambre;

        return $this;
    }

    /**
     * Get chambre
     *
     * @return integer 
     */
    public function getChambre()
    {
        return $this->chambre;
    }

    /**
     * Set cuisine
     *
     * @param integer $cuisine
     * @return logement
     */
    public function setCuisine($cuisine)
    {
        $this->cuisine = $cuisine;

        return $this;
    }

    /**
     * Get cuisine
     *
     * @return integer 
     */
    public function getCuisine()
    {
        return $this->cuisine;
    }

    /**
     * Set dateAnnonce
     *
     * @param \DateTime $dateAnnonce
     * @return logement
     */
    public function setDateAnnonce($dateAnnonce)
    {
        $this->dateAnnonce = $dateAnnonce;

        return $this;
    }

    /**
     * Get dateAnnonce
     *
     * @return \DateTime 
     */
    public function getDateAnnonce()
    {
        return $this->dateAnnonce;
    }

    
    /**
     * Set dateFinAnnonce
     *
     * @param \DateTime $dateFinAnnonce
     * @return logement
     */
    public function setDateFinAnnonce($dateFinAnnonce)
    {
        $this->dateFinAnnonce = $dateFinAnnonce;

        return $this;
    }

    /**
     * Get dateFinAnnonce
     *
     * @return \DateTime 
     */
    public function getDateFinAnnonce()
    {
        return $this->dateFinAnnonce;
    }

    /**
     * Set dateUpdateAnnonce
     *
     * @param \DateTime $dateUpdateAnnonce
     * @return logement
     */
    public function setDateUpdateAnnonce($dateUpdateAnnonce)
    {
        $this->dateUpdateAnnonce = $dateUpdateAnnonce;

        return $this;
    }

    /**
     * Get dateUpdateAnnonce
     *
     * @return \DateTime 
     */
    public function getDateUpdateAnnonce()
    {
        return $this->dateUpdateAnnonce;
    }
    
    
    
     
     
    /**
     * @ORM\PrePersist
      */
    public function setDateAnnonceValue()
    {
        if(!$this->getDateAnnonce())
        {
            $this->dateAnnonce = new \DateTime();
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function setDateUpdateAnnonceValue()
    {
        $this->dateUpdateAnnonce = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function setDateFinAnnonceValue()
        {
            if(!$this->getDateFinAnnonce())
            {
                $now = $this->getDateFinAnnonce() ? $this->getDateFinAnnonce()->format('U') : time();
                $this->dateFinAnnonce = new \DateTime(date('Y-m-d H:i:s', $now + 86400 * 30));
            }
        }

    /**
     * Set image
     *
     * @param \djepo\LocationBundle\Entity\image $image
     * @return image
     */
    public function setImage(\djepo\LocationBundle\Entity\image $image = null)
    {
        $this->image = $image;

        return $this;
    }
    /**
     * Get image
     *
     * @return \djepo\LocationBundle\Entity\image 
     */
    public function getImage()
    {
        return $this->image;
    }
 

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evaluations = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->setDateAnnonce($dateAnnonce)new \DateTime()
    }

    /**
     * Add evaluations
     *
     * @param \djepo\LocationBundle\Entity\evaluation $evaluations
     * @return logement
     */
    public function addEvaluation(\djepo\LocationBundle\Entity\evaluation $evaluations)
    {
        $this->evaluations[] = $evaluations;
        $evaluations->setLogement($this);
        return $this;
    }

    /**
     * Remove evaluations
     *
     * @param \djepo\LocationBundle\Entity\evaluation $evaluations
     */
    public function removeEvaluation(\djepo\LocationBundle\Entity\evaluation $evaluations)
    {
        $this->evaluations->removeElement($evaluations);
        
    }

    /**
     * Get evaluations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }
     

    /**
     * Set nbEvaluations
     *
     * @param integer $nbEvaluations
     * @return logement
     */
    public function setNbEvaluations($nbEvaluations)
    {
        $this->nbEvaluations = $nbEvaluations;

        return $this;
    }

    /**
     * Get nbEvaluations
     *
     * @return integer 
     */
    public function getNbEvaluations()
    {
        return $this->nbEvaluations;
    }
}
