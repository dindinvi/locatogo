<?php

namespace djepo\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * propriete
 *
 * @ORM\Table(name="loca_propriete")
 * @ORM\Entity(repositoryClass="djepo\LocationBundle\Entity\proprieteRepository")
 * 
 */
class propriete
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
* @ORM\ManyToOne(targetEntity="djepo\LocationBundle\Entity\proprietaire", cascade={"Persist"})
* @ORM\JoinColumn(nullable=false)
* @Assert\Valid()
*/
private $proprietaire;
   
 /**
     * @var string
     * @ORM\Column(name="typepropriete", type="string", length=50, nullable=false)
     */
    private $typepropriete;

    
    /**
* @ORM\ManyToOne(targetEntity="djepo\UserBundle\Entity\Adresse", cascade={"Persist"})
* @ORM\JoinColumn(nullable=false)
* @Assert\Valid()
*/
private $adresse;

    

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez Entrer une description")
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(name="nomPropriete", type="string", length=255, nullable=true)
     */
    private $nomPropriete;


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
     * Set description
     *
     * @param string $description
     * @return propriete
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set nomPropriete
     *
     * @param string $nomPropriete
     * @return propriete
     */
    public function setNomPropriete($nomPropriete)
    {
        $this->nomPropriete = $nomPropriete;

        return $this;
    }

    /**
     * Get nomPropriete
     *
     * @return string 
     */
    public function getNomPropriete()
    {
        return $this->nomPropriete;
    }

    /**
     * Set proprietaire
     *
     * @param \djepo\LocationBundle\Entity\proprietaire $proprietaire
     * @return propriete
     */
    public function setProprietaire(\djepo\LocationBundle\Entity\proprietaire $proprietaire)
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

    /**
     * Set adresse
     *
     * @param \djepo\UserBundle\Entity\Adresse $adresse
     * @return propriete
     */
    public function setAdresse(\djepo\UserBundle\Entity\Adresse $adresse)
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
     * Set typepropriete
     *
     * @param string $typepropriete
     * @return proprietaire
     */
    public function setTypepropriete($typepropriete)
    {
        $this->typepropriete = $typepropriete;

        return $this;
    }

    /**
     * Get typepropriete
     *
     * @return string 
     */
    public function getTypepropriete()
    {
        return $this->typepropriete;
    }

}
