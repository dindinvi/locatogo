<?php

namespace djepo\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\LocationBundle\Entity\logement;
use djepo\LocationBundle\Entity\location;

use djepo\LocationBundle\Form\locationType;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * location controller.
 *  RESTE A FAIRE LAGESTION DE LA SUPPRESSION DES ROLES
 */
class locationController extends Controller
{
    /**
     * Lists all location entities en cours. 
     * si admin liste tte les locations en  sinon liste juste les locations en cours de user
     */
    public function indexVanAction()
    {
         $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
        
        $em = $this->getDoctrine()->getManager();
        // si utilisateur sans annonce
            if (! $this->get('security.context')->isGranted('ROLE_ADMIN')) {
                    $entities = $em->getRepository('djepoLocationBundle:location')->getReservation($user->getId());
            }else {
                    $entities =  $em->getRepository('djepoLocationBundle:location')->getReservation();//->getReservationAll();
            }
     
            $this->get('session')->set('selecteur','Van');
          
        return $this->render('djepoLocationBundle:location:index.html.twig', array(
            'entities' => $entities,
            'entitiesNbr' =>count($entities)
        ));
    }
   /**
     * Confirmation de reservation . 
    * uniquement par proprietaire
     * 
     */
     public function indexProAction()
    {
         $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
        
        $em = $this->getDoctrine()->getManager();
        // si utilisateur sans annonce
                  
            $entities2 = null;
          if ( $this->get('security.context')->isGranted('ROLE_PROPRIO')) { 
               $entities2 = $em->getRepository('djepoLocationBundle:location')->getProprioReservation($user->getId());
          }
          
          $this->get('session')->set('selecteur','Pro');
          
        return $this->render('djepoLocationBundle:location:index.html.twig', array(
            'entities2' => $entities2, 
            'entitiesNbr2' =>count($entities2)
        ));
    }
    /**
     * Creates a new location entity.
     *
     */
    public function createAction(Request $request)
    {
         $user = $this->container->get('security.context')->getToken()->getUser();
       if (!is_object($user)) { throw new AccessDeniedException('Vous n\'êtes pas authentifié.'); }
          if (! $this->get('security.context')->isGranted('ROLE_VACANCIER')) {
                   $user->addRole('ROLE_VACANCIER') ;
          }
        $em = $this->getDoctrine()->getManager();
        $logement = $em->getRepository('djepoLocationBundle:logement')->find($this->get('session')->get('encour_id'));
                
        $mailProprio = $logement->getPropriete()->getProprietaire()->getPersonne()->getMailSender();
        $userProprio = $logement->getPropriete()->getProprietaire()->getPersonne()->getFullName();
            
        $entity  = new location();
        $entity->setMontantLoyer($logement->getMontantLoyer());
        $entity->setTypeLoyer($logement->getTypeImmeuble());
        $entity->setLogement($logement);
        $entity->setUser($user); 
        $form = $this->createForm(new locationType(), $entity);
        
        $form->bind($request);

        if ($form->isValid()) { 
            $em->persist($entity);
            $em->flush();
            // message flash pour user
            $this->get('session')->getFlashBag()->add('success', 'reservationLocation.flash.success');
             $this->get('session')->getFlashBag()->add('info', 'reservationLocation.flash.info');

               // envoye un mail au proprio
            $message = \Swift_Message::newInstance()
                ->setSubject($userProprio.',  une nouvelle démande de réservation')
                ->setFrom($this->container->getParameter('mailer_user'))
               ->setTo($mailProprio);
            $message->setBody($this->renderView('djepoLocationBundle:location:reservationMail.html.twig',  array('entity' => $entity)));

             $this->get('mailer')->send($message); 
 
        }
        else {
                    // get a ConstraintViolationList
                  $errors = $this->get('validator')->validate($entity);
                   // iterate on it
                  $this->get('session')->getFlashBag()->add('info', 'Merci de vérifier les données du formulaire de réservation');
                  foreach( $errors as $error )
                  {
                      $this->get('session')->getFlashBag()->add('danger',     
                         $error->getPropertyPath().' : ' // the field that caused the error
                         .$error->getMessage() // the error message
                      );
                  }
      } 
      
        $url = $this->generateUrl('logement_logementShow',
        array(
               'tLogement' => $this->get('session')->get('encour_tLogement') ,
               'ville' => $this->get('session')->get('encour_ville') ,
               'libelle' => $this->get('session')->get('encour_libelle'),
               'id' => $this->get('session')->get('encour_id')
          ));

      return $this->redirect($url);
    
    }

    /**
     * Displays a form to create a new location entity.
     *  LA CR2ATION NE PEUT AVOIR LIEU QUE DANS LES ANNONCES
     * id de logement concerné par la reservation
     * 
     */
    public function newAction($id, logement $logement)
    {
         $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		return $this->render('djepoLocationBundle:location:new_content.html.twig');
    	}
               
        $entity = new location();
        $entity->setLogement($logement);
        $entity->setMontantLoyer($logement->getMontantLoyer());
        $entity->setTypeLoyer($logement->getTypeImmeuble());
        
         $entity->setUser($user);
        $form   = $this->createForm(new locationType(), $entity);

        return $this->render('djepoLocationBundle:location:new_content.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a location entity.
     */
    public function showAction($id)  // id du location
    {
        //correspond soir a admin soit a l user
       $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
        
        $em = $this->getDoctrine()->getManager();
        if ( ($this->get('security.context')->isGranted('ROLE_ADMIN')) || ($this->get('security.context')->isGranted('ROLE_PROPRIO')) ) { 
          $entity = $em->getRepository('djepoLocationBundle:location')->getShowReservation($id);// id location
        }
        else {// le user normal
                $entity = $em->getRepository('djepoLocationBundle:location')->find($id); // id location
                 if (!$entity) {
                         throw $this->createNotFoundException('Unable to find location entity.');
                }
        }
         
          $deleteForm = $this->createDeleteForm($id);
         $confirmerForm = $this->createConfirmerForm($id);// le controle de l acces au formulaire dans la vue
        return $this->render('djepoLocationBundle:location:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'confirmer_form' => $confirmerForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing location entity.
     * a gere avec SECURE
     */
    public function editAction($id, location $entity )
    {
         $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
       
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find location entity.');
        }

        $editForm = $this->createForm(new locationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:location:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing location entity.
     *
     */
    public function updateAction(Request $request, $id, location $entity )
    {
        
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new locationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
               $em->persist($entity);
               $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'editLocation.flash.success');

            if ($this->get('session').get('selecteur') == 'Pro' ){
                  return $this->redirect($this->generateUrl('reservation_pro'));
            }  else { 

                  return $this->redirect($this->generateUrl('reservation_van'));
           }
        }
        return $this->render('djepoLocationBundle:location:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a location entity.
     *  a gere avec SECURE
     */
    public function deleteAction(Request $request, $id, location $entity)
    {
       
        $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
          if (! $this->get('security.context')->isGranted('ROLE_ADMIN')) {              
            $this->get('session')->getFlashBag()->add('warning', 'editLocation.flash.warning');
             if ($this->get('session').get('selecteur') == 'Pro' ){
                  return $this->redirect($this->generateUrl('reservation_pro'));
            }  else { 

                  return $this->redirect($this->generateUrl('reservation_van'));
           }
          }
        
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
              
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('location'));
    }

    /**
     * Creates a form to delete a location entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
     
    
    private function createConfirmerForm($id)
    {
        return $this->createDeleteForm($id);
       
    }
    /*
     *  a gere avec SECURE
     */
    public function ConfirmerAction(Request $request, $id)
    {
        $form = $this->createConfirmerForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoLocationBundle:location')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find location entity.');
            }
            $entity->setValide(true);
            $em->persist($entity); 
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('success', 'confirmerLocation.flash.success');
        }

        if ($this->get('session').get('selecteur') == 'Pro' ){
                  return $this->redirect($this->generateUrl('reservation_pro'));
            }  else { 

                  return $this->redirect($this->generateUrl('reservation_van'));
           }
    }

}

