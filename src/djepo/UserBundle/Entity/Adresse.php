<?php

namespace djepo\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * djepo\UserBundle\Entity\Adresse
 *
 * @ORM\Table(name="loca_adresse")
 * @ORM\Entity(repositoryClass="djepo\UserBundle\Entity\AdresseRepository")
 */

class Adresse
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManytoOne(targetEntity="djepo\UserBundle\Entity\Ville", cascade={"Persist","Remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $ville;
    /**
     * @var smallint $numeroVoie
     * @ORM\Column(name="numeroVoie", type="string", length=5, nullable=true)
     * @Assert\Regex(pattern="/\d/", message="Votre numéro de voie n'est pas valide.")
     * 
     */
    private $numeroVoie;

    /**
     * @var string $libelleAdd
     * @ORM\Column(name="libelleAdd", type="string", length=255, nullable=true)
     * @Assert\Regex(pattern="/\D/", message="Votre libelle d'adresse n'est pas valide.")
     */
    private $libelleAdd;

    /**
     * @var smallint $codePostal
     * @ORM\Column(name="codePostal", type="string",length=5, nullable=true)
     * @Assert\MaxLength(10)
     */
    private $codePostal;


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
     * Set numeroVoie
     *
     * @param smallint $numeroVoie
     */
    public function setNumeroVoie($numeroVoie)
    {
        $this->numeroVoie = $numeroVoie;
    }

    /**
     * Get numeroVoie
     *
     * @return smallint 
     */
    public function getNumeroVoie()
    {
        return $this->numeroVoie;
    }

    /**
     * Set libelleAdd
     *
     * @param string $libelleAdd
     */
    public function setLibelleAdd($libelleAdd)
    {
        $this->libelleAdd = $libelleAdd;
    }

    /**
     * Get libelleAdd
     *
     * @return string 
     */
    public function getLibelleAdd()
    {
        return $this->libelleAdd; 
    }

    /**
     * Set codePostal
     *
     * @param smallint $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * Get codePostal
     *
     * @return smallint 
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }
    
    //GESTION VILLE
    public function setVille(\djepo\UserBundle\Entity\Ville $ville)
    {
    	$this->ville = $ville;
    }
   
    public function getVille()
    {
    	return $this->ville;
    }
    
     public function getAddressGMap()
    {
        return  $this->numeroVoie .' '.$this->libelleAdd;
    }
    
}