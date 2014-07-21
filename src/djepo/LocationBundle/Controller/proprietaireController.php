<?php

namespace djepo\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\LocationBundle\Entity\proprietaire;
use djepo\LocationBundle\Form\proprietaireType;
//use djepo\LocationBundle\Form\proprietaireNewType;
/**
 * proprietaire controller.
 *
 */
class proprietaireController extends Controller
{
    /**
     * Lists all proprietaire entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoLocationBundle:proprietaire')->findAll();

        return $this->render('djepoLocationBundle:proprietaire:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new proprietaire entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new proprietaire();
        $form = $this->createForm(new proprietaireType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('proprietaire_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoLocationBundle:proprietaire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new proprietaire entity.
     *
     */
    public function newAction()
    {
        $entity = new proprietaire();
        $form   = $this->createForm(new proprietaireType(), $entity);

        return $this->render('djepoLocationBundle:proprietaire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a proprietaire entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:proprietaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find proprietaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:proprietaire:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing proprietaire entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:proprietaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find proprietaire entity.');
        }

        $editForm = $this->createForm(new proprietaireType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:proprietaire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing proprietaire entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:proprietaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find proprietaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new proprietaireType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('proprietaire_edit', array('id' => $id)));
        }

        return $this->render('djepoLocationBundle:proprietaire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a proprietaire entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoLocationBundle:proprietaire')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find proprietaire entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('proprietaire'));
    }

    /**
     * Creates a form to delete a proprietaire entity by id.
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
