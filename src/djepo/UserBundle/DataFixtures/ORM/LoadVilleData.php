<?php

namespace djepo\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use djepo\UserBundle\Entity\Ville;

class LoadVilleData  extends AbstractFixture implements OrderedFixtureInterface   {
    //put your code here

    public function load(ObjectManager $manager)
    {
        $ville = new Ville(); 
        $ville->setNomVille('Kara');
        $ville->setLibelle('TG');
        
        $ville2 = new Ville(); 
        $ville2->setNomVille('Cotonou');
        $ville2->setLibelle('BN');
         /*GESTION DES CLES */
        
        $manager->persist($ville);$manager->persist($ville2);
        $manager->flush();
        
        $this->addReference('user_ville', $ville);
        $this->addReference('user_ville2', $ville2);
    }
 public function getOrder()
  {
    return 1; // the order in which fixtures will be loaded
  }
  
}
?>
