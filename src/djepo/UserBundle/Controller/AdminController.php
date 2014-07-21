<?php

namespace djepo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception;
use djepo\UserBundle\Entity\Admin;
use djepo\UserBundle\Form\AdminType;
use djepo\UserBundle\Form\adminHandler;

/**
 * Admin controller.
 *
 */
class AdminController extends Controller
{
    /**
     * Lists all Admin entities.
     */
    public function indexAction()
    {
        
        $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
      
          
             $user_mail = $user->getEmail();  
             //$pers_adr = $user->getPersonne()->getAdresse()->getId();
    	// Récupération du service
            $session = $this->get('session');
            $session->set('user_name', $user);
     
           $session->set('user_mail', $user_mail );   	
    	  // $session->set('pers_adr',$pers_adr );
    	 
    	$motscle = $this->getDoctrine()->getManager()
    	->getRepository('djepoMainBundle:MotsCle')
    	->find(6);//Acceuil administration
    	
        return $this->render('djepoUserBundle:Admin:index.html.twig', 
        		array('motscle' => $motscle));
    
    }

    public function modifierMailAction()
    {
    	$user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
    	
    	 $admin = new Admin;
    	
    	 $form = $this->createForm(new AdminType, $admin);
    	 $formHandler = new AdminHandler(
    	 		$form,
    	 		 $this->get('request'),
    	 		 $this->getDoctrine()->getEntityManager()
    	 		
    	 		);
    	 
                if( $formHandler->process() ) {

                       // Pour récupérer le service UserManager du bundle
                       $userManager = $this->get('fos_user.user_manager');
                       $session = $this->get('session');
                     
                      try{ 
                            $user->setEmail($session->get('user_mail'));
                            
                            $userManager->updateUser($user);
                              return $this->redirect($this->generateUrl('djepoUser_profile'));
                      } catch (\Doctrine\DBAL\DBALException $e) {
                               $this->get('session')->getFlashBag()->clear();
                               
                                $this->get('session')->getFlashBag()->add('warning', 'admin.flash.warning');
                                $this->get('session')->getFlashBag()->add('danger', 'admin.flash.danger');
                     } 
                              
                }
       
       $motscle = $this->getDoctrine()->getEntityManager()
    	 ->getRepository('djepoMainBundle:MotsCle')
    	 ->find(7);// administration mail
    	return $this->render('djepoUserBundle:Admin:modifierMail.html.twig',
    			array(
    					'form' => $form->createView(),
    					'motscle' => $motscle,
    					));
    }
    
    
    public function deleteAction()
    {
         $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
    	// Pour récupérer le service UserManager du bundle
    	  $userD = $this->get('fos_user.user_manager')->findUserBy(array('username' => $user));
           // Pour supprimer un utilisateur
    	$userD->deleteUser($user);     
    	
        $motscle = $this->getDoctrine()->getManager()
    	->getRepository('djepoMainBundle:MotsCle')
    	->find(6);//Acceuil administration
    	
        return $this->render('djepoUserBundle:Admin:index.html.twig', 
        		array('motscle' => $motscle));
    }
}
