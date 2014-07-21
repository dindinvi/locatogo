<?php

namespace djepo\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\MainBundle\Entity\formContact;
use djepo\MainBundle\Form\formContactType;

use JMS\SecurityExtraBundle\Annotation\Secure;


/**
 * formContact controller.
 *
 */
class formContactController extends Controller
{
    /**
     * Lists all formContact entities.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('djepoMainBundle:formContact')->findAll();

        return $this->render('djepoMainBundle:formContact:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new formContact entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new formContact();
        $form = $this->createForm(new formContactType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formcontact_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoMainBundle:formContact:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new formContact entity.
     *
     */
    public function newAction()
    {
        $entity = new formContact();
        $form   = $this->createForm(new formContactType(), $entity);

        return $this->render('djepoMainBundle:formContact:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a formContact entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoMainBundle:formContact')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find formContact entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoMainBundle:formContact:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing formContact entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoMainBundle:formContact')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find formContact entity.');
        }

        $editForm = $this->createForm(new formContactType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoMainBundle:formContact:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing formContact entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoMainBundle:formContact')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find formContact entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new formContactType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formcontact_edit', array('id' => $id)));
        }

        return $this->render('djepoMainBundle:formContact:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a formContact entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoMainBundle:formContact')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find formContact entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('formcontact'));
    }

    /**
     * Creates a form to delete a formContact entity by id.
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
