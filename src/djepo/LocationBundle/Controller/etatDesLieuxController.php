<?php

namespace djepo\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\LocationBundle\Entity\etatDesLieux;
use djepo\LocationBundle\Form\etatDesLieuxType;

/**
 * etatDesLieux controller.
 *
 */
class etatDesLieuxController extends Controller
{
    /**
     * Lists all etatDesLieux entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoLocationBundle:etatDesLieux')->findAll();

        return $this->render('djepoLocationBundle:etatDesLieux:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new etatDesLieux entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new etatDesLieux();
        $form = $this->createForm(new etatDesLieuxType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('no_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoLocationBundle:etatDesLieux:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new etatDesLieux entity.
     *
     */
    public function newAction()
    {
        $entity = new etatDesLieux();
        $form   = $this->createForm(new etatDesLieuxType(), $entity);

        return $this->render('djepoLocationBundle:etatDesLieux:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a etatDesLieux entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:etatDesLieux')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find etatDesLieux entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:etatDesLieux:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing etatDesLieux entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:etatDesLieux')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find etatDesLieux entity.');
        }

        $editForm = $this->createForm(new etatDesLieuxType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:etatDesLieux:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing etatDesLieux entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:etatDesLieux')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find etatDesLieux entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new etatDesLieuxType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('no_edit', array('id' => $id)));
        }

        return $this->render('djepoLocationBundle:etatDesLieux:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a etatDesLieux entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoLocationBundle:etatDesLieux')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find etatDesLieux entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('no'));
    }

    /**
     * Creates a form to delete a etatDesLieux entity by id.
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
