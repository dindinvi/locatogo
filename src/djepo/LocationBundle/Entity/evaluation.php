<?php

namespace djepo\LocationBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * evaluation
 *
 * @ORM\Table(name="loca_evaluation")
 * @ORM\Entity(repositoryClass="djepo\LocationBundle\Entity\evaluationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class evaluation
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
* @ORM\OneToOne(targetEntity="djepo\UserBundle\Entity\User", cascade={"Persist"})
* @ORM\JoinColumn(nullable=false)
* @Assert\Valid()   
*/
private $user;
    /**
* @ORM\ManyToOne(targetEntity="djepo\LocationBundle\Entity\logement", inversedBy="evaluations", cascade={"Persist"})
* @ORM\JoinColumn(nullable=false)
* @Assert\Valid()
*/
private $logement;

    /**
     * @var integer
     *@Assert\Regex(pattern="/\D/", message="Votre note n'est pas valide.")
     * @Assert\Max(5)
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

    /**
     * @var string
     * @Assert\Regex(pattern="/\d/", message="commentaire.")
     * @ORM\Column(name="commentaire", type="text")
     */
    private $commentaire;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="dateEvaluation", type="datetime")
     */
    private $dateEvaluation;

    /**
     * @var integer
     * @ORM\Column(name="etatDuBien", type="integer", nullable=true)
     */
    private $etatDuBien;

    /**
     * @var integer
     *
     * @ORM\Column(name="situation", type="integer", nullable=true)
     */
    private $situation;
 

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
         $this->setDateEvaluation( new \Datetime()); // Par défaut, la date del'article est la date d'aujourd'hui
    }

    /**
     * Set note
     *
     * @param integer $note
     * @return evaluation
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return evaluation
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set dateEvaluation
     *
     * @param \DateTime $dateEvaluation
     * @return evaluation
     */
    public function setDateEvaluation($dateEvaluation)
    {
        $this->dateEvaluation = $dateEvaluation;

        return $this;
    }

    /**
     * Get dateEvaluation
     *
     * @return \DateTime 
     */
    public function getDateEvaluation()
    {
        return $this->dateEvaluation;
    }

    /**
     * Set etatDuBien
     *
     * @param integer $etatDuBien
     * @return evaluation
     */
    public function setEtatDuBien($etatDuBien)
    {
        $this->etatDuBien = $etatDuBien;

        return $this;
    }

    /**
     * Get etatDuBien
     *
     * @return integer 
     */
    public function getEtatDuBien()
    {
        return $this->etatDuBien;
    }

    /**
     * Set situation
     *
     * @param integer $situation
     * @return evaluation
     */
    public function setSituation($situation)
    {
        $this->situation = $situation;

        return $this;
    }

    /**
     * Get situation
     *
     * @return integer 
     */
    public function getSituation()
    {
        return $this->situation;
    }

    /**
     * Set user
     *
     * @param \djepo\UserBundle\Entity\User $user
     * @return evaluation
     */
    public function setUser(\djepo\UserBundle\Entity\User $user)
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
     * Set logement
     *
     * @param \djepo\LocationBundle\Entity\logement $logement
     * @return evaluation
     */
    public function setLogement(\djepo\LocationBundle\Entity\logement $logement)
    {
        $this->logement = $logement;

        return $this;
    }

    /**
     * Get logement
     *
     * @return \djepo\LocationBundle\Entity\logement 
     */
    public function getLogement()
    {
        return $this->logement;
    }
    
       /**
    * @ORM\prePersist
    */
    public function increase()
    {
        $nbEvaluations = $this->getLogement()->getNbEvaluations();
        $this->getLogement()->setNbEvaluations($nbEvaluation+1);
    }
    /**
    * @ORM\preRemove
    */
    public function decrease()
    {
        $nbEvaluation = $this->getLogement()->getNbEvaluations();
        $this->getLogement()->setNbEvaluations($nbEvaluation-1);
    }
}
