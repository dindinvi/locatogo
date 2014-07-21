<?php

namespace djepo\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\UserBundle\Entity\Adresse;
use djepo\UserBundle\Form\AdresseType;

/**
 * Adresse controller.
 *
 */
class AdresseController extends Controller
{
    /**
     * Lists all Adresse entities.
     *@Secure(roles="ROLE_SUPER_ADMIN")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoUserBundle:Adresse')->findAll();

        return $this->render('djepoUserBundle:Adresse:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Adresse entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Adresse();
        $form = $this->createForm(new AdresseType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adresse_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoUserBundle:Adresse:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Adresse entity.
     *
     */
    public function newAction()
    {
        $entity = new Adresse();
        $form   = $this->createForm(new AdresseType(), $entity);

        return $this->render('djepoUserBundle:Adresse:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Adresse entity.
     *
     */
    public function showAction($id)
    {
         $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
    	
    	$pers_adr=$this->get('session')->get('pers_adr');
    	
    	if ( $pers_adr != $id) {
    		throw $this->createNotFoundException('Vous n\'êtes pas authentifié sous le bon speudo!');
    	}
    	
    	$em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('djepoUserBundle:Adresse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adresse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoUserBundle:Adresse:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
        
        
    }

    /**
     * Displays a form to edit an existing Adresse entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoUserBundle:Adresse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adresse entity.');
        }

        $editForm = $this->createForm(new AdresseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoUserBundle:Adresse:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Adresse entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoUserBundle:Adresse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adresse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AdresseType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

          //  return $this->redirect($this->generateUrl('adresse_edit', array('id' => $id)));
        //}
             $this->get('request')->getSession()->setFlash('admin-update', 'Vos données ont été mise à jour');
            return $this->redirect($this->generateUrl('SdkProjetTravaux_profile'));
        }
        
        return $this->render('djepoUserBundle:Adresse:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
        
    }

    /**
     * Deletes a Adresse entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoUserBundle:Adresse')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Adresse entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adresse'));
    }

    /**
     * Creates a form to delete a Adresse entity by id.
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
}
