<?php

namespace djepo\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use djepo\MainBundle\Entity\MotsCle;

class UtilisationController extends Controller
{
	private $motscle;
    
    public function indexAction()
    {
    	$motscle = $this->getDoctrine()->getEntityManager()
    	->getRepository('djepoMainBundle:MotsCle')
    	->find(4);//condition d'utilisation a faire
    	   
        return $this->render('djepoMainBundle:Utilisation:index.html.twig', 
        		array('motscle' => $motscle));
    }
    
    public function guideProprietaireAction()
    {
    	$motscle = $this->getDoctrine()->getEntityManager()
    	->getRepository('djepoMainBundle:MotsCle')
    	->find(4);//condition d'utilisation a faire
    	   
        return $this->render('djepoMainBundle:Utilisation:guideProprietaire.html.twig', 
        		array('motscle' => $motscle));
    }
    
    public function guideVancancierAction()
    {
    	$motscle = $this->getDoctrine()->getEntityManager()
    	->getRepository('djepoMainBundle:MotsCle')
    	->find(4);//condition d'utilisation a faire
    	   
        return $this->render('djepoMainBundle:Utilisation:guideVancancier.html.twig', 
        		array('motscle' => $motscle));
    }
}
