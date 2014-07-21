<?php

namespace djepo\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * djepo\UserBundle\Entity\Ville
 *
 * @ORM\Table(name="loca_ville")
 * @ORM\Entity(repositoryClass="djepo\UserBundle\Entity\VilleRepository")
 */
class Ville
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    

    /**
     * @var string $nomVille
     *
     * @ORM\Column(name="nomVille", type="string", length=255)
     * @Assert\NotBlank(message="Entrez votre ville")
     */
    private $nomVille;

   
    /**
     * @var string $libelle POUR pays
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     * @Assert\NotBlank(message="Entrez votre pays")
     */
    private $libelle;
    
/**
     * @var float     Latitude of the position
     *@ORM\Column(name="lat", type="float", nullable=true)
     */
    protected $lat;
 
    /**
     * @var float     Longitude of the position
     * @ORM\Column(name="lng", type="float", nullable=true)
     */
    protected $lng;
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

       
    /**
     * Set libelle
     *
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
    	$this->libelle = $libelle;
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
    public function getLat()
    {
        return $this->lat;
    }
 
    public function setLat($lat)
    {
        if (is_string($lat)) {
            $lat = floatval($lat);
        }
        $this->lat = $lat;
    }
 
    public function getLng()
    {
        return $this->lng;
    }
 
    public function setLng($lng)
    {
        if (is_string($lng)) {
            $lng = floatval($lng);
        }
        $this->lng = $lng;
    }
   
}