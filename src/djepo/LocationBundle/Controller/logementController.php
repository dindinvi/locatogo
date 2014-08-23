<?php

namespace djepo\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\LocationBundle\Entity\logement;
use djepo\LocationBundle\Entity\proprietaire;
use djepo\LocationBundle\Entity\propriete;
use djepo\LocationBundle\Entity\image;

use djepo\LocationBundle\Form\logementType;


/**
 * logement controller.
 * RESTE A FAIRE LAGESTION DE LA SUPPRESSION DES ROLES
 */
class logementController extends Controller
{
    /**
     * Lists all logement entities.
     * active ou non a utiliser en administration 
     * NON UTILISE ACTUELLEMENT
     
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoLocationBundle:logement')->findAll();

        return $this->render('djepoLocationBundle:logement:index.html.twig', array(
            'entities' => $entities,
        ));
    }
*/
   /******************************************************************************************/ 
     /** OK
     *  SELECTION LES 3 DERNIERS ANNONCES ACYIVES.
      * AFFICHABLE DANS LA PAGE D ACCEUIL
     * restriction: logements activés
     */
     public function selectionIndexAction()
    {
        $em = $this->getDoctrine()->getManager(); 
        $entities = $em->getRepository('djepoLocationBundle:logement')->getSearchSelection(3);
          
       return $this->render('djepoLocationBundle:logement:selectionIndex.html.twig', array(
            'entities' => $entities ,
             'totalAnnonces'=>count($entities)
        ));
    }
    
     /**
     * Lists all logement entities.
     * restriction: logements activés
     * UTILISE AUSSI POUR AFFICHER TTE LES ANNONCES
     */
    public function logementSearchAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $maxParPage = 10;//$this->container->getParameter('10');
        $entities = $em->getRepository('djepoLocationBundle:logement')->getSearchLocation(
                $page,
                 $maxParPage,
                $this->get('session')->get('search_dateD'),
                $this->get('session')->get('search_dateF'),
                $this->get('session')->get('search_ville'),
                $this->get('session')->get('search_budget')
        );// GESTION DE LA PANGINATION
        
        $total_jobs = count($entities);
        $last_page = ceil($total_jobs / $maxParPage);//$jobs_per_page);
         $previous_page = $page > 1 ? $page - 1 : 1;
        $next_page = $page < $last_page ? $page + 1 : $last_page;
        
         $this->get('session')->set('search_actuel', $page);
         
       return $this->render('djepoLocationBundle:logement:logementSearch.html.twig', array(
            'entities' => $entities ,
            'last_page' => $last_page,
            'previous_page' => $previous_page,
            'current_page' => $page,
            'next_page' => $next_page,
            'total_jobs' => $total_jobs
        ));
       
       
    }
    
            
    /**
     * Creates a new logement entity.
     *
     */
    
    public function createAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
        if (! $this->get('security.context')->isGranted('ROLE_VACANCIER')) {
                   $user->addRole('ROLE_PROPRIO') ;
          }
      
       $pers = $user->getPersonne();
       $proprio = $pers->getProprietaire();
       
       if(!$proprio){  
           $proprio = new proprietaire();
           $proprio->setPersonne($pers);
         }
                 
        $pro = new propriete();
        $pro->setProprietaire($proprio);
        
         $entity = new logement();
        $entity->setPropriete($pro);
        
          //$img = new image();
        //$entity->setImage($img);
        $form = $this->createForm(new logementType(), $entity); 
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->clear();
            $this->get('session')->getFlashBag()->add('success', 'logement.flash.success');
            return $this->redirect($this->generateUrl('logement_preview', array('id' => $entity->getId())));
        }

        return $this->render('djepoLocationBundle:logement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new logement entity.
     * creation d un logement 
     * RECUPERATION DES DONNEES DE USER
     */
    public function newAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
        
       $pers = $user->getPersonne();// recupération de la personne User       
       $proprio = $pers->getProprietaire();
       
       if(!$proprio){  
           $proprio = new proprietaire();
           $proprio->setPersonne($pers);
         }
       
       $pro = new propriete();
        $pro->setProprietaire($proprio);
        
       
        $entity = new logement();        
        $entity->setPropriete($pro);
        // $img = new image();
       // $entity->setImage($img);
        
       
        $form   = $this->createForm(new logementType(), $entity);
        return $this->render('djepoLocationBundle:logement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a logement entity.
     * affichage a partir du menu admin des annonces
     */
    public function showAction($id, logement $entity)
    {
        $em = $this->getDoctrine()->getManager();
 
        $deleteForm = $this->createDeleteForm($id);
        $espClient_show = 1;
        return $this->render('djepoLocationBundle:logement:logementShow.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'espClient_show' => $espClient_show,
            ));
    }
 /**
     * Finds and displays a logement entity.
     * afficher le detail des annonce en mode visiteur
  * les parametres sont importatant juste pour  URL
     */
    public function logementShowAction($tLogement,$ville,$libelle, $id, logement $entity)
    {
        $em = $this->getDoctrine()->getManager();

            $this->get('session')->set('encour_ville',$ville);
            $this->get('session')->set('encour_tLogement',$tLogement);
            $this->get('session')->set('encour_libelle',$libelle);
            $this->get('session')->set('encour_id',$id);
                        
        return $this->render('djepoLocationBundle:logement:logementShow.html.twig', array(
            'entity'      => $entity  ));
    }
    
    /**
     * Displays a form to edit an existing logement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:logement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find logement entity.');
        }

        $editForm = $this->createForm(new logementType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:logement:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing logement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:logement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find logement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new logementType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'logement.flash.success');
            return $this->redirect($this->generateUrl('logement_preview', array('id' => $id))); 
        }

        return $this->render('djepoLocationBundle:logement:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a logement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoLocationBundle:logement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find logement entity.');
            }

            $em->remove($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success', 'supLogement.flash.success');
        }

        return $this->redirect($this->generateUrl('djepoUser_profile'));
    }

    /**
     * Creates a form to delete a logement entity by id.
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
    
    public function gMapAction(){
                  
          $map = $this->container->get('djepo_main.GoogleMapAPI');
        
        //(3) On ajoute la clef de Google Maps.
            $map->setAPIKey('AIzaSyCqpM-LUXWSova1n59xkhsJ_UqfABT29FQ');

            //(4) On ajoute les caractéristiques que l'on désire à notre carte.
            $map->setWidth("800px");
            $map->setHeight("500px");
            $map->setCenterCoords ('2', '48');
           $map->setZoomLevel (5);
 
           return $this->render('djepoLocationBundle:logement:gMap.html.twig', array(
            'map'      => $map,
        ));
    }
    
     /**
     * Finds and displays a logement entity en mode preview.
     *
     */
    public function previewAction($id)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:logement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find logement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $publishForm = $this->createPublishForm($id);
         
        return $this->render('djepoLocationBundle:logement:logementShow.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(), 
            'publish_form' => $publishForm->createView(),
            ));
    }
    
    private function createPublishForm($id)
    {
        return $this->createDeleteForm($id);
       
    }
    
    public function publishAction(Request $request, $id, logement $entity)
    {
        $form = $this->createPublishForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /*
            $entity = $em->getRepository('djepoLocationBundle:logement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find logement entity.');
            }
             * 
             */
            $entity->setIsActivated(true);
            $em->persist($entity); 
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('success', 'publishLogement.flash.success');
        }

        return $this->forward('djepoLocationBundle:logement:mesAnnonces');
        //$this->redirect($this->generateUrl('djepoUser_profile', array('is_Validated' => $id)));
    }
    
    /**
     * Lists all logement entities.
     * restriction: logements activés
     */
    public function mesAnnoncesAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
        
                             
        $em = $this->getDoctrine()->getManager();
       
        $entities = $em->getRepository('djepoLocationBundle:logement')->getMesAnnonces($user->getId());
        $nbr = count($entities);
          return $this->render('djepoLocationBundle:logement:MesAnnoncesIndex.html.twig', array(
            'entities' => $entities, 
            'nbrEntities' => $nbr,
             
        ));
        
       
    }
            
}
