<?php

namespace djepo\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\UserBundle\Entity\Personne;
use djepo\UserBundle\Form\PersonneType;

/**
 * Personne controller.
 *
 */
class PersonneController extends Controller
{
    /**
     * Lists all Personne entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoUserBundle:Personne')->findAll();

        return $this->render('djepoUserBundle:Personne:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Personne entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Personne();
        $form = $this->createForm(new PersonneType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('personne_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoUserBundle:Personne:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Personne entity.
     *
     */
    public function newAction()
    {
        $entity = new Personne();
        $form   = $this->createForm(new PersonneType(), $entity);

        return $this->render('djepoUserBundle:Personne:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Personne entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoUserBundle:Personne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personne entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoUserBundle:Personne:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Personne entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoUserBundle:Personne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personne entity.');
        }

        $editForm = $this->createForm(new PersonneType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoUserBundle:Personne:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Personne entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoUserBundle:Personne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personne entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PersonneType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('personne_edit', array('id' => $id)));
        }

        return $this->render('djepoUserBundle:Personne:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Personne entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoUserBundle:Personne')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Personne entity.');
            }
            
           //$myUser = $entity->getUser();
            //$em_user = $this->get('fos_user.user_manager');
            // $this->get('fos_user.user_manager')->deleteUser($myUser);
             
           $em->remove($entity);
           $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'personne.flash.success');
        }

        return $this->redirect($this->generateUrl('fos_user_security_logout'));
    }

    /**
     * Creates a form to delete a Personne entity by id.
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
    public function showDeleteAction(Personne $entity)
    {
    	 
    	$user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
    
    	if ($user != $entity->getUser()->getUsername()) {
    		throw $this->createNotFoundException('Vous n\'êtes pas authentifié sous le bon speudo!');
    	}
    
    	$deleteForm = $this->createDeleteForm($entity->getId());
    
    	return $this->render('djepoUserBundle:Personne:delete.html.twig', array(
    			'entity'      => $entity,
    			'delete_form' => $deleteForm->createView(),
    	));
    }
}
