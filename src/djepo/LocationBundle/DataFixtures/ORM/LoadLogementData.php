<?php

namespace djepo\LocationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use djepo\LocationBundle\Entity\logement;

class LoadLogementData  extends AbstractFixture implements OrderedFixtureInterface   {
    //put your code here
public function load(ObjectManager $manager)
    {
           $loca_propriete = array('loca_propriete', 'loca_propriete2', 'loca_propriete3', 'loca_propriete4');
           $loca_img = array('loca_img1', 'loca_img2', 'loca_img3', 'loca_img4');
            $noms = array('loca_logement', 'loca_logement2', 'loca_logement3', 'loca_logement4');
            $type = array('villa', 'appartement', 'tente', 'hotel','chambre');
           // $token = array('vill', 'appament', 'ten', 'otel','chbre');
            $c=1;
           foreach($noms as $y => $nom)
            { 
               
                    foreach($noms as $i => $nom)
                    {
                        // On crée la catégorie
                        $liste[$i] = new  logement();
                        
                        
                        //$liste[$i]->setToken($nom.$c);
                        $liste[$i]->setDateAnnonce(new \DateTime());
                        $liste[$i]->setCuisine($c*2); 
                        $liste[$i]->setChambre($c+4); 
                        $liste[$i]->setSbb($c+10); 
                        $liste[$i]->setSejour($c*4);
                        $liste[$i]->setTransport('train, voiture'); 
                        $liste[$i]->setSurface($c*2); 
                        $liste[$i]->setTypeImmeuble($type[$c]); 
                        $liste[$i]->setNombrePiece($c+1);
                        $liste[$i]->setLibelle("maison de vere");
                        $liste[$i]->setNbEvaluations($c);
                       $liste[$i]->setPropriete($this->getReference($loca_propriete[$y]));
                       $liste[$i]->setImage($this->getReference($loca_img[$y]));
                        // On la persiste
                        $manager->persist($liste[$i]);
                    }
                  $c += 1;  
                   //$this->addReference($nom, $liste[$i]);
           }
            // On déclenche l'enregistrement
             $manager->flush();
             
                   
    }
 public function getOrder()
  {
    return 7; // the order in which fixtures will be loaded
  }
  
}
?>
