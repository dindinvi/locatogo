<?php

namespace djepo\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\LocationBundle\Entity\etat;
use djepo\LocationBundle\Form\etatType;

/**
 * etat controller.
 *
 */
class etatController extends Controller
{
    /**
     * Lists all etat entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoLocationBundle:etat')->findAll();

        return $this->render('djepoLocationBundle:etat:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new etat entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new etat();
        $form = $this->createForm(new etatType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('etat_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoLocationBundle:etat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new etat entity.
     *
     */
    public function newAction()
    {
        $entity = new etat();
        $form   = $this->createForm(new etatType(), $entity);

        return $this->render('djepoLocationBundle:etat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a etat entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:etat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find etat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:etat:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing etat entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:etat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find etat entity.');
        }

        $editForm = $this->createForm(new etatType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:etat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing etat entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:etat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find etat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new etatType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('etat_edit', array('id' => $id)));
        }

        return $this->render('djepoLocationBundle:etat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a etat entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoLocationBundle:etat')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find etat entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('etat'));
    }

    /**
     * Creates a form to delete a etat entity by id.
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
