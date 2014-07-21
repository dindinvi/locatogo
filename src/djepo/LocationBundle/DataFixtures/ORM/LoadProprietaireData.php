<?php

namespace djepo\LocationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use djepo\LocationBundle\Entity\proprietaire;

class LoadProprietaireData  extends AbstractFixture implements OrderedFixtureInterface   {
    //put your code here
public function load(ObjectManager $manager)
    {
        $proprio = new proprietaire();
        $proprio2 = new proprietaire();

        $proprio->setToken('appament');
        $proprio2->setToken('villedelome');
        
         /*GESTION DES CLES */
        $proprio->setPersonne($this->getReference('user_pers'));
         $proprio2->setPersonne($this->getReference('user_pers2'));
         
        $manager->persist($proprio);  $manager->persist($proprio2);
        $manager->flush();
        
        $this->addReference('loca_proprio', $proprio);
        $this->addReference('loca_proprio2', $proprio2);
    }
 public function getOrder()
  {
    return 5; // the order in which fixtures will be loaded
  }
  
}
?>
