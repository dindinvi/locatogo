<?php

namespace djepo\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\UserBundle\Entity\facture;
use djepo\UserBundle\Form\factureType;

/**
 * facture controller.
 *
 */
class factureController extends Controller
{
    /**
     * Lists all facture entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoUserBundle:facture')->findAll();

        return $this->render('djepoUserBundle:facture:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new facture entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new facture();
        $form = $this->createForm(new factureType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('facture_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoUserBundle:facture:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new facture entity.
     *
     */
    public function newAction()
    {
        $entity = new facture();
        $form   = $this->createForm(new factureType(), $entity);

        return $this->render('djepoUserBundle:facture:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a facture entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoUserBundle:facture')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find facture entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoUserBundle:facture:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing facture entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoUserBundle:facture')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find facture entity.');
        }

        $editForm = $this->createForm(new factureType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoUserBundle:facture:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing facture entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoUserBundle:facture')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find facture entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new factureType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('facture_edit', array('id' => $id)));
        }

        return $this->render('djepoUserBundle:facture:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a facture entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoUserBundle:facture')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find facture entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('facture'));
    }

    /**
     * Creates a form to delete a facture entity by id.
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
