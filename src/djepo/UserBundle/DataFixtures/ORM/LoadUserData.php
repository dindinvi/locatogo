<?php

namespace djepo\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use djepo\UserBundle\Entity\User;

class LoadUserData  extends AbstractFixture implements OrderedFixtureInterface   {
    //put your code here
public function load(ObjectManager $manager)
    {
       // $user = new User(); 

         /*GESTION DES CLES */
       // $user->setPersonne($this->getReference('user_pers'));
        
       // $manager->persist($user);
       // $manager->flush();
        
       // $this->addReference('user_user', $user);
    }
 public function getOrder()
  {
    return 4; // the order in which fixtures will be loaded
  }
  
}
?>
