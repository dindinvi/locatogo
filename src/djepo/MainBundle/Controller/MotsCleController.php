<?php

namespace djepo\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\MainBundle\Entity\MotsCle;
use djepo\MainBundle\Form\MotsCleType;


/**
 * MotsCle controller.
 *
 */
class MotsCleController extends Controller
{
    /**
     * Lists all MotsCle entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoMainBundle:MotsCle')->findAll();

        return $this->render('djepoMainBundle:MotsCle:index.html.twig', array(
            'entities' => $entities,
        ));
        
        
    }

    /**
     * Creates a new MotsCle entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new MotsCle();
        $form = $this->createForm(new MotsCleType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('motscle_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoMainBundle:MotsCle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
        
    }

    /**
     * Displays a form to create a new MotsCle entity.
     *
     */
    public function newAction()
    {
        $entity = new MotsCle();
        $form   = $this->createForm(new MotsCleType(), $entity);

        return $this->render('djepoMainBundle:MotsCle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a MotsCle entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoMainBundle:MotsCle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MotsCle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoMainBundle:MotsCle:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing MotsCle entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoMainBundle:MotsCle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MotsCle entity.');
        }

        $editForm = $this->createForm(new MotsCleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoMainBundle:MotsCle:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing MotsCle entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoMainBundle:MotsCle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MotsCle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new MotsCleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('motscle_edit', array('id' => $id)));
        }

        return $this->render('djepoMainBundle:MotsCle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a MotsCle entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoMainBundle:MotsCle')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MotsCle entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('motscle'));
    }

    /**
     * Creates a form to delete a MotsCle entity by id.
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
