<?php

namespace djepo\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\LocationBundle\Entity\logement;
use djepo\LocationBundle\Entity\proprietaire;
use djepo\LocationBundle\Entity\propriete;

use djepo\LocationBundle\Entity\image;
use djepo\LocationBundle\Form\logementType;
use djepo\LocationBundle\Form\logementNewType;
/**
 * logement controller.
 *
 */
class logementController extends Controller
{
    /**
     * Lists all logement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoLocationBundle:logement')->findAll();

        return $this->render('djepoLocationBundle:logement:index.html.twig', array(
            'entities' => $entities,
        ));
    }

     /**
     * Lists all logement entities.
     *
     */
    public function logementIndexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoLocationBundle:logement')->findAll();
        
        //$motscle = $em->getRepository('djepoMainBundle:MotsCle')->find(7);
        
        return $this->render('djepoLocationBundle:logement:logementIndex.html.twig', array(
            'entities' => $entities,
            //'motscle' =>$motscle
        ));
    }
    /**
     * Creates a new logement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new logement();
        //$form = $this->createForm(new logementType(), $entity);
         $form = $this->createForm(new logementNewType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('logement_show', array('id' => $entity->getId())));
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
       $pers = $user->getPersonne();
        $proprio = new proprietaire();
        $proprio->setPersonne($pers);
        
        $pro = new propriete();
        $pro->setProprietaire($proprio);
        
        $entity = new logement();
        
        $entity->setPropriete($pro);
        
        //$entity = new logement();
        $form   = $this->createForm(new logementNewType(), $entity);
        return $this->render('djepoLocationBundle:logement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a logement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:logement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find logement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:logement:logementShow.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }
 /**
     * Finds and displays a logement entity.
     * afficher le detail des annonce en mode visiteur
  * les parametres sont importatant juste pour  URL
     */
    public function logementShowAction($tLogement,$ville,$libelle, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:logement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find logement entity.');
        }
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
            'edit_form'   => $editForm->createView(),
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

            return $this->redirect($this->generateUrl('logement_edit', array('id' => $id)));
        }

        return $this->render('djepoLocationBundle:logement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
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
        }

        return $this->redirect($this->generateUrl('logement'));
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
            
}
