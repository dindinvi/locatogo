<?php
namespace djepo\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use djepo\UserBundle\Entity\Personne;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity
 * @ORM\Table(name="loca_user")
 *
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
   
    /**
     *
     * @ORM\OneToOne(targetEntity="djepo\UserBundle\Entity\Personne", inversedBy="user", cascade={"Persist","Remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    protected $personne;
    
    
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $facebookId;

    

    public function __construct()
    {
        parent::__construct();
        // your own logic        
    }
    
    public function serialize()
    {
        return serialize(array($this->facebookId, parent::serialize()));
    }

    public function unserialize($data)
    {
        list($this->facebookId, $parentData) = unserialize($data);
        parent::unserialize($parentData);
    }
    
    

    /**
     * @param string $facebookID
     * @return void
     */
    public function setFacebookID($facebookID=null)
    {
        $this->facebookId = $facebookID;        
        if ($this->username=="")    //si on n'a pas de username
        {
            $this->setUsername("BIENVENUE");
        }        
    }

    /**
     * @return string
     */
    public function getFacebookID()
    {
        return $this->facebookId;
    }

    /**
     * @param Array
     */
    
    public function setFBData($fbdata, $exist)
    {   
         
           
        if (isset($fbdata['id'])) {
            $this->setFacebookID($fbdata['id']);
            $this->addRole('ROLE_FACEBOOK');
        }
        /* pas de mise a jour des donnees de l utilisateur
         si la connexion est autorise
         */
       if ($exist === false) {
            $this->setPersonne(new Personne());
            
             if (isset($fbdata['first_name'])) {
                $this->getPersonne()->setFirstname($fbdata['first_name']); 
                 $this->setUsername($fbdata['first_name']);
           }
           if (isset($fbdata['last_name'])) {
               //$test = $fbdata['last_name'] .' '.$fbdata['locale'] ;
             $this->getPersonne()->setLastname( $fbdata['last_name']);  
           }
           if (isset($fbdata['gender'])) { 
               $genre = $fbdata['gender'];
               if( $genre == 'male')
                         $this->getPersonne()->setTypeEntite('Mr'); 
              else if ( $genre == 'female')
                      $this->getPersonne()->setTypeEntite('Mme');
              else
                     $this->getPersonne()->setTypeEntite('Société');
           }
           
             if (isset($fbdata['birthday'])) { 
               $this->getPersonne()->setDateN($fbdata['birthday']);  
           }
           if (isset($fbdata['email'])) {
               $this->setEmail($fbdata['email']);
           }
           
      }
     
        
        
        
        
    }
    

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
     * Set personne
     *
     * @param \djepo\UserBundle\Entity\Personne $personne
     * @return User
     */
    public function setPersonne(\djepo\UserBundle\Entity\Personne $personne)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return \djepo\UserBundle\Entity\Personne 
     */
    public function getPersonne()
    {
        return $this->personne;
    }
}
