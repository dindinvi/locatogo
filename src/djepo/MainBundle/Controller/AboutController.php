<?php

namespace djepo\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use djepo\MainBundle\Entity\MotsCle;

class AboutController extends Controller
{
	private $motscle;
    
    public function indexAction()
    {
    	$motscle = $this->getDoctrine()->getEntityManager()
    	->getRepository('djepoMainBundle:MotsCle')
    	->find(4);//ABOUT QUI NOUS SOMME
    	   
        return $this->render('djepoMainBundle:About:index.html.twig', 
        		array('motscle' => $motscle));
    }
}
