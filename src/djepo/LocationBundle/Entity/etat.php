<?php

namespace djepo\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * etat
 *
 * @ORM\Table(name="loca_etat")
 * @ORM\Entity(repositoryClass="djepo\LocationBundle\Entity\etatRepository")
 */
class etat
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
* @ORM\ManyToOne(targetEntity="djepo\LocationBundle\Entity\etatDesLieux", cascade={"Persist"})
* @ORM\JoinColumn(nullable=false)
* @Assert\Valid()
*/
private $etatDesLieux;

    /**
     * @var string
     * @ASSERT\NotBlank()
     * 
     * @ORM\Column(name="libelle", type="string", length=255, nullable=false)
     */
    private $libelle;

    /**
     * @var string
     *@ASSERT\NotBlank()
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     */
    private $etat;


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
     * @return etat
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
     * Set etat
     *
     * @param string $etat
     * @return etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set etatDesLieux
     *
     * @param \djepo\LocationBundle\Entity\etatDesLieux $etatDesLieux
     * @return etat
     */
    public function setEtatDesLieux(\djepo\LocationBundle\Entity\etatDesLieux $etatDesLieux)
    {
        $this->etatDesLieux = $etatDesLieux;

        return $this;
    }

    /**
     * Get etatDesLieux
     *
     * @return \djepo\LocationBundle\Entity\etatDesLieux 
     */
    public function getEtatDesLieux()
    {
        return $this->etatDesLieux;
    }
}
