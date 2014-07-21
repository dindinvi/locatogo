<?php

namespace djepo\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\LocationBundle\Entity\propriete;
use djepo\LocationBundle\Form\proprieteType;
//use djepo\LocationBundle\Form\proprieteNewType;
/**
 * propriete controller.
 *
 */
class proprieteController extends Controller
{
    /**
     * Lists all propriete entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoLocationBundle:propriete')->findAll();

        return $this->render('djepoLocationBundle:propriete:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new propriete entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new propriete();
        $form = $this->createForm(new proprieteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('propriete_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoLocationBundle:propriete:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new propriete entity.
     *
     */
    public function newAction()
    {
        $entity = new propriete();
        $form   = $this->createForm(new proprieteType(), $entity);

        return $this->render('djepoLocationBundle:propriete:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a propriete entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:propriete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find propriete entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:propriete:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing propriete entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:propriete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find propriete entity.');
        }

        $editForm = $this->createForm(new proprieteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:propriete:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing propriete entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:propriete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find propriete entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new proprieteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('propriete_edit', array('id' => $id)));
        }

        return $this->render('djepoLocationBundle:propriete:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a propriete entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoLocationBundle:propriete')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find propriete entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('propriete'));
    }

    /**
     * Creates a form to delete a propriete entity by id.
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
