<?php

namespace djepo\PrestationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\PrestationBundle\Entity\prestation;
use djepo\PrestationBundle\Form\prestationType;

/**
 * prestation controller.
 *
 */
class prestationController extends Controller
{
    /**
     * Lists all prestation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoPrestationBundle:prestation')->findAll();

        return $this->render('djepoPrestationBundle:prestation:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new prestation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new prestation();
        $form = $this->createForm(new prestationType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('prestation_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoPrestationBundle:prestation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new prestation entity.
     *
     */
    public function newAction()
    {
        $entity = new prestation();
        $form   = $this->createForm(new prestationType(), $entity);

        return $this->render('djepoPrestationBundle:prestation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a prestation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoPrestationBundle:prestation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find prestation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoPrestationBundle:prestation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing prestation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoPrestationBundle:prestation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find prestation entity.');
        }

        $editForm = $this->createForm(new prestationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoPrestationBundle:prestation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing prestation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoPrestationBundle:prestation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find prestation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new prestationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('prestation_edit', array('id' => $id)));
        }

        return $this->render('djepoPrestationBundle:prestation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a prestation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoPrestationBundle:prestation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find prestation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('prestation'));
    }

    /**
     * Creates a form to delete a prestation entity by id.
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
