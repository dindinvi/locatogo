<?php

namespace djepo\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\LocationBundle\Entity\location;
use djepo\LocationBundle\Form\locationType;

/**
 * location controller.
 *
 */
class locationController extends Controller
{
    /**
     * Lists all location entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoLocationBundle:location')->findAll();

        return $this->render('djepoLocationBundle:location:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new location entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new location();
        $form = $this->createForm(new locationType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('location_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoLocationBundle:location:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new location entity.
     *
     */
    public function newAction()
    {
        $entity = new location();
        $form   = $this->createForm(new locationType(), $entity);

        return $this->render('djepoLocationBundle:location:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a location entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:location')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find location entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:location:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing location entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:location')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find location entity.');
        }

        $editForm = $this->createForm(new locationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:location:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing location entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:location')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find location entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new locationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('location_edit', array('id' => $id)));
        }

        return $this->render('djepoLocationBundle:location:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a location entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoLocationBundle:location')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find location entity.');
            }

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
}
