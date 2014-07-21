<?php

namespace djepo\LocationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use djepo\LocationBundle\Entity\image;

class LoadImageData  extends AbstractFixture implements OrderedFixtureInterface   {
    //put your code here
public function load(ObjectManager $manager)
    {
         $img1 = new image(); 
         $img2 = new image();
         $img3 = new image(); 
         $img4 = new image();
          
          $img1->setUrl("picto_1_carteAfrique.jpg"); $img1->setAlt("carte Afrique.jpg");
          $img1->setUrl2("picto_1_carteAfrique.jpg") ;$img1->setAlt2("carte Afrique.jpg");
          $img1->setUrl3("picto_1_carteAfrique.jpg") ; $img1->setAlt3("carte Afrique.jpg");
          
          $img2->setUrl("picto_2_carteAustrale.jpg"); $img2->setAlt("carte Australe");
          $img2->setUrl2("picto_2_carteAustrale.jpg") ;$img2->setAlt2("carte Australe");
          $img2->setUrl3("picto_2_carteAustrale.jpg") ; $img2->setAlt3("carte Australe");
          
           $img3->setUrl("picto_3_carteCentral.jpg"); $img3->setAlt("carte Central");
          $img3->setUrl2("picto_3_carteCentral.jpg") ;$img3->setAlt2("carte Central");
          $img3->setUrl3("picto_3_carteCentral.jpg") ; $img3->setAlt3("carte Central");
          
          $img4->setUrl("picto_4_carteEast.jpg"); $img4->setAlt("carte East");
          $img4->setUrl2("picto_4_carteEast.jpg") ;$img4->setAlt2("carte East");
          $img4->setUrl3("picto_4_carteEast.jpg") ; $img4->setAlt3("carte East");
          
        $manager->persist($img1);$manager->persist($img2);
        $manager->persist($img3);$manager->persist($img4);
        $manager->flush();
        
        $this->addReference('loca_img2', $img2);
        $this->addReference('loca_img1', $img1);
        $this->addReference('loca_img3', $img3);
        $this->addReference('loca_img4', $img4);
    }
    
 public function getOrder()
  {
    return 6; // the order in which fixtures will be loaded
  }
}
?>
