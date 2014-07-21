<?php

namespace djepo\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\UserBundle\Entity\reglement;
use djepo\UserBundle\Form\reglementType;

/**
 * reglement controller.
 *
 */
class reglementController extends Controller
{
    /**
     * Lists all reglement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoUserBundle:reglement')->findAll();

        return $this->render('djepoUserBundle:reglement:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new reglement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new reglement();
        $form = $this->createForm(new reglementType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('reglement_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoUserBundle:reglement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new reglement entity.
     *
     */
    public function newAction()
    {
        $entity = new reglement();
        $form   = $this->createForm(new reglementType(), $entity);

        return $this->render('djepoUserBundle:reglement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reglement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoUserBundle:reglement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find reglement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoUserBundle:reglement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing reglement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoUserBundle:reglement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find reglement entity.');
        }

        $editForm = $this->createForm(new reglementType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoUserBundle:reglement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing reglement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoUserBundle:reglement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find reglement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new reglementType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('reglement_edit', array('id' => $id)));
        }

        return $this->render('djepoUserBundle:reglement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reglement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoUserBundle:reglement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find reglement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('reglement'));
    }

    /**
     * Creates a form to delete a reglement entity by id.
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
