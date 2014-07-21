<?php

namespace djepo\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use djepo\UserBundle\Entity\Adresse;

class LoadAdresseData  extends AbstractFixture implements OrderedFixtureInterface   {
    //put your code here
public function load(ObjectManager $manager)
    {
        $adr = new Adresse();
        
        $adr->setNumeroVoie("1");
        $adr->setLibelleAdd("Boulevard du PARDON" );
        $adr->setCodePostal("66666");
        
        $adrPropriete = new Adresse();
        $adrPropriete->setNumeroVoie("23");
        $adrPropriete->setLibelleAdd("Allée du chemin de fer" );
        $adrPropriete->setCodePostal("00005");
        
        $adrPropriete2 = new Adresse();
        $adrPropriete2->setNumeroVoie("32");
        $adrPropriete2->setLibelleAdd("rue de NULLE PART" );
        $adrPropriete2->setCodePostal("7555");
        
         /*GESTION DES CLES */
        $adr->setVille($this->getReference('user_ville'));
        $adrPropriete->setVille($this->getReference('user_ville'));
        $adrPropriete2->setVille($this->getReference('user_ville2'));
        
        $manager->persist($adr);
        $manager->persist($adrPropriete);$manager->persist($adrPropriete2);
        $manager->flush();
        
        $this->addReference('user_adr', $adr);
        $this->addReference('user_adrPropriete', $adrPropriete);
         $this->addReference('user_adrPropriete2', $adrPropriete2);
    }
 public function getOrder()
  {
    return 2; // the order in which fixtures will be loaded
  }
  
}
?>
