<?php

namespace djepo\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\LocationBundle\Entity\image;
use djepo\LocationBundle\Entity\logement;

use djepo\LocationBundle\Form\imageType;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * image controller.
 *
 */
class imageController extends Controller
{
    /**
     * Lists all image entities.
     ** @Secure(roles="ROLE_PROPRIO")
     */
    public function indexAction()
    {
         $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
        
        $em = $this->getDoctrine()->getManager();
         if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {// donc proprio
             
              $entities = $em->getRepository('djepoLocationBundle:logement')->getImage($user->getId());
            }else {
              $entities =  $em->getRepository('djepoLocationBundle:logement')->getImage();//->getReservationAll();
            }
         
            return $this->render('djepoLocationBundle:image:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new image entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new image();
        $form = $this->createForm(new imageType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('djepoImg_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoLocationBundle:image:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new image entity.
     *
     */
    public function newAction()//$id, logement $log
    {
        $entity = new image();
        
        $form   = $this->createForm(new imageType(), $entity);

        return $this->render('djepoLocationBundle:image:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a image entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find image entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:image:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing image entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find image entity.');
        }

        $editForm = $this->createForm(new imageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:image:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing image entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find image entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new imageType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('djepoImg_edit', array('id' => $id)));
        }

        return $this->render('djepoLocationBundle:image:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a image entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoLocationBundle:image')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find image entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('no'));
    }

    /**
     * Creates a form to delete a image entity by id.
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
