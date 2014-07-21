<?php

namespace djepo\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use djepo\UserBundle\Entity\Personne;

class LoadPersonneData extends AbstractFixture implements OrderedFixtureInterface  {
    //put your code here
public function load(ObjectManager $manager)
    {
        $pers = new Personne(); 
        $pers->setTypeEntite("Mr");
        $pers->setTelFixe("9876543210");
        $pers->setTelPortable("0123456789");
        $pers->setFirstname("firstname");
        $pers->setLastname("Kone");
         
        $pers2 = new Personne(); 
        $pers2->setTypeEntite("Mr");
        $pers2->setTelFixe("9876543210");
        $pers2->setTelPortable("0123456789");
        $pers2->setFirstname("DELA");
        $pers2->setLastname("DEGBESSOU");
        
        /*GESTION DES CLES */
        $pers->setAdresse($this->getReference('user_adr'));
        $pers2->setAdresse($this->getReference('user_adrPropriete2'));
        
        $manager->persist($pers);$manager->persist($pers2);
        $manager->flush();
        
        $this->addReference('user_pers2', $pers2);
         $this->addReference('user_pers', $pers);
    }
 public function getOrder()
  {
    return 3; // the order in which fixtures will be loaded
  }
  
}
?>
