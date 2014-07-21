<?php

namespace djepo\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use djepo\MainBundle\Entity\formContact;
use djepo\MainBundle\Form\formContactType;
use djepo\MainBundle\Form\formContactHandler;
use djepo\MainBundle\Entity\MotsCle;


class ContactController extends Controller
{
  // private $formContact;
	 
   
    public function indexAction()
    {
        $formContact = new formContact();
       
        $form = $this->createform(new formContactType,$formContact);
    	$formHandler = new formContactHandler(
    			$form, $this->get('request'), 
    			$this->getDoctrine()->getManager(),
    			$this->get('mailer')
    			);
    	
    	 // On ex�cute le traitement du formulaire. S'il retourne true, alors le formulaire a bien �t� trait�
        if( $formHandler->process()){
        	                
		       $message = \Swift_Message::newInstance()
				->setSubject('Contact enquiry from symblog')
				->setFrom($this->container->getParameter('mailer_user'))
                               ->setTo($this->container->getParameter('mailer_user_sender'));
                       
		        $message->setBody($this->renderView('djepoMainBundle:Contact:contactMail.txt.twig',
						 array('enquiry' => $formContact)));
				
			 $this->get('mailer')->send($message);
                         
                         
        	return $this->redirect($this->generateUrl('djepoMain_accueil'));
        }
                     
                        
        $motscle = $this->getDoctrine()->getManager()
    	->getRepository('djepoMainBundle:MotsCle')
    	->find(5);//ABOUT QUI NOUS SOMME
       return $this->render('djepoMainBundle:Contact:index.html.twig',
        		     array('form' => $form->createView(),
        		 		'motscle' => $motscle ));
    }
    
   public function contactLogementAction(){
        $formContact = new formContact();
         
              $aQui = $this->get('session')->get('extensionMail') ;
              $annonce = $this->get('session')->get('annonceMail') ; 
              $formContact->setSubject($annonce);
              $formContact->setMessage( 
              $this->get('session')->get('encour_tLogement').$this->get('session')->get('encour_ville') .$this->get('session')->get('encour_id').$this->get('session')->get('encour_libelle'));
              $form = $this->createform(new formContactType,$formContact);
              $formHandler = new formContactHandler(
                            $form, $this->get('request'), 
                            $this->getDoctrine()->getManager(),
                            $this->get('mailer')
                            );
    	
        if( $formHandler->process()){
        	                
            $message = \Swift_Message::newInstance()
                     ->setSubject('Contact enquiry from symblog')
                     ->setFrom($this->container->getParameter('mailer_user'))
                    ->setTo($aQui);
            $message->setBody($this->renderView('djepoMainBundle:Contact:contactMail.txt.twig',  array('enquiry' => $formContact)));

             $this->get('mailer')->send($message); 

             $url = $this->generateUrl('logement_logementShow',
             array(
                 'tLogement' => $this->get('session')->get('encour_tLogement') ,
             'ville' => $this->get('session')->get('encour_ville') ,
             'libelle' => $this->get('session')->get('encour_libelle'),
                 'id' => $this->get('session')->get('encour_id')
               ));

      return $this->redirect($url);
                      
        }
                        
        $motscle = $this->getDoctrine()->getManager()
    	->getRepository('djepoMainBundle:MotsCle')
    	->find(5);//ABOUT QUI NOUS SOMME
       return $this->render('djepoMainBundle:Contact:contactLogement.html.twig',
        		     array('form' => $form->createView(),
        		 		'motscle' => $motscle ));
    }
}
