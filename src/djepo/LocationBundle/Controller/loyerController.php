<?php

namespace djepo\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\LocationBundle\Entity\loyer;
use djepo\LocationBundle\Form\loyerType;

/**
 * loyer controller.
 *
 */
class loyerController extends Controller
{
    /**
     * Lists all loyer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoLocationBundle:loyer')->findAll();

        return $this->render('djepoLocationBundle:loyer:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new loyer entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new loyer();
        $form = $this->createForm(new loyerType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('loyer_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoLocationBundle:loyer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new loyer entity.
     *
     */
    public function newAction()
    {
        $entity = new loyer();
        $form   = $this->createForm(new loyerType(), $entity);

        return $this->render('djepoLocationBundle:loyer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a loyer entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:loyer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find loyer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:loyer:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing loyer entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:loyer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find loyer entity.');
        }

        $editForm = $this->createForm(new loyerType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:loyer:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing loyer entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:loyer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find loyer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new loyerType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('loyer_edit', array('id' => $id)));
        }

        return $this->render('djepoLocationBundle:loyer:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a loyer entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoLocationBundle:loyer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find loyer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('loyer'));
    }

    /**
     * Creates a form to delete a loyer entity by id.
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
