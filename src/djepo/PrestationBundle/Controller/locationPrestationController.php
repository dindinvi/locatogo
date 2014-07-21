<?php

namespace djepo\PrestationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\PrestationBundle\Entity\locationPrestation;
use djepo\PrestationBundle\Form\locationPrestationType;

/**
 * locationPrestation controller.
 *
 */
class locationPrestationController extends Controller
{
    /**
     * Lists all locationPrestation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoPrestationBundle:locationPrestation')->findAll();

        return $this->render('djepoPrestationBundle:locationPrestation:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new locationPrestation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new locationPrestation();
        $form = $this->createForm(new locationPrestationType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('locationprestation_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoPrestationBundle:locationPrestation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new locationPrestation entity.
     *
     */
    public function newAction()
    {
        $entity = new locationPrestation();
        $form   = $this->createForm(new locationPrestationType(), $entity);

        return $this->render('djepoPrestationBundle:locationPrestation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a locationPrestation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoPrestationBundle:locationPrestation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find locationPrestation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoPrestationBundle:locationPrestation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing locationPrestation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoPrestationBundle:locationPrestation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find locationPrestation entity.');
        }

        $editForm = $this->createForm(new locationPrestationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoPrestationBundle:locationPrestation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing locationPrestation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoPrestationBundle:locationPrestation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find locationPrestation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new locationPrestationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('locationprestation_edit', array('id' => $id)));
        }

        return $this->render('djepoPrestationBundle:locationPrestation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a locationPrestation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoPrestationBundle:locationPrestation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find locationPrestation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('locationprestation'));
    }

    /**
     * Creates a form to delete a locationPrestation entity by id.
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
