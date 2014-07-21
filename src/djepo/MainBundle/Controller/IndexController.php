<?php

namespace djepo\MainBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use djepo\MainBundle\Entity\MotsCle;

class IndexController extends Controller
{
    public function indexAction()
    {
    	$motscle = $this->getDoctrine()->getManager()->getRepository('djepoMainBundle:MotsCle')->find(1);//home
    	 return $this->render('djepoMainBundle:Index:index.html.twig', array( 'motscle' => $motscle ));
    }
}
