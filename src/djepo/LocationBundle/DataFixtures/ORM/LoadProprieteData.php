<?php

namespace djepo\LocationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use djepo\LocationBundle\Entity\propriete;

class LoadProprieteData  extends AbstractFixture implements OrderedFixtureInterface   {
    //put your code here
public function load(ObjectManager $manager)
    {
        $propriete = new propriete();  
        $propriete->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                                     aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.');
        $propriete->setNomPropriete("villa bonheur");
        $propriete->setTypepropriete("Appartement");
        
        $propriete2 = new propriete();  
        $propriete2->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                                     aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.');
        $propriete2->setNomPropriete("villa");
        $propriete2->setTypepropriete("Maison");
        
        $propriete3 = new propriete();  
        $propriete3->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                                     aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.');
        $propriete3->setNomPropriete("villa bonheur");
        $propriete3->setTypepropriete("Villa");
        
        $propriete4 = new propriete();  
        $propriete4->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                                     aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.');
        $propriete4->setNomPropriete("villa");
        $propriete4->setTypepropriete("Villa");
        
         /*GESTION DES CLES */
        $propriete->setAdresse($this->getReference('user_adrPropriete'));
         $propriete->setProprietaire($this->getReference('loca_proprio'));
         
          $propriete2->setAdresse($this->getReference('user_adrPropriete2'));
         $propriete2->setProprietaire($this->getReference('loca_proprio2'));
         
         $propriete3->setAdresse($this->getReference('user_adrPropriete'));
         $propriete3->setProprietaire($this->getReference('loca_proprio'));
         
          $propriete4->setAdresse($this->getReference('user_adrPropriete'));
         $propriete4->setProprietaire($this->getReference('loca_proprio2'));
         
        $manager->persist($propriete);$manager->persist($propriete2);
         $manager->persist($propriete3);$manager->persist($propriete4);
        $manager->flush();
        
        $this->addReference('loca_propriete', $propriete);
         $this->addReference('loca_propriete2', $propriete2);
         $this->addReference('loca_propriete3', $propriete3);
         $this->addReference('loca_propriete4', $propriete4);
    }
 public function getOrder()
  {
    return 6; // the order in which fixtures will be loaded
  }
  
}
?>
