<?php

namespace djepo\PrestationBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * prestation
 *
 * @ORM\Table(name="loca_prestation")
 * @ORM\Entity(repositoryClass="djepo\PrestationBundle\Entity\prestationRepository")
 */
class prestation
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
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;


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
     * Set typePrestation
     *
     * @param string $typePrestation
     * @return prestation
     */
    public function setDescription($typePrestation)
    {
        $this->description = $typePrestation;

        return $this;
    }

    /**
     * Get typePrestation
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
