<?php

namespace djepo\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\LocationBundle\Entity\evaluation;
use djepo\LocationBundle\Form\evaluationType;

/**
 * evaluation controller.
 *
 */
class evaluationController extends Controller
{
    /**
     * Lists all evaluation entities if role = admin.
     * else list of user
     */
    public function indexAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
        
        $em = $this->getDoctrine()->getManager();
         if ( $this->get('security.context')->isGranted('ROLE_ADMIN')) {
                 $entities = $em->getRepository('djepoLocationBundle:evaluation')->findAll();
         }
         else {
                 $entities = $em->getRepository('djepoLocationBundle:evaluation')->findBy(array('user' => $user->getId()),  null, null);
         }
         
        return $this->render('djepoLocationBundle:evaluation:index.html.twig', array(
            'entities' => $entities,
            'entitiesNbr' =>count($entities),
        ));
    }

    /**
     * Creates a new evaluation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new evaluation();
        $form = $this->createForm(new evaluationType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('eval_show', array('id' => $entity->getId())));
        }

        return $this->render('djepoLocationBundle:evaluation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new evaluation entity.
     *
     */
    public function newAction()
    {
       
         $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
        $entity = new evaluation();
        $form   = $this->createForm(new evaluationType(), $entity);

        return $this->render('djepoLocationBundle:evaluation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a evaluation entity.
     * pas de contraintes particuliers. acces a tous user authentifié
     */
    public function showAction($id)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('djepoLocationBundle:evaluation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find evaluation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:evaluation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }
    
 public function showAppreciationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $message = "Soyez le premier à laisser une appréciation!";
        $entity = $em->getRepository('djepoLocationBundle:evaluation') ->findBy(array('logement' => $id), null, null);
        

        if (!$entity) { $entity= false;   }
      return $this->render('djepoLocationBundle:evaluation:appreciation.html.twig', array(
            'entity'    => $entity,
             'message'  => $message));
    }
    /**
     * Displays a form to edit an existing evaluation entity.
     *  a gere avec SECURE
     */
    public function editAction($id)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
          if (! $this->get('security.context')->isGranted('ROLE_ADMIN')) {              
            $this->get('session')->getFlashBag()->add('warning', 'editEvaluation.flash.warning');
            return $this->redirect($this->generateUrl('eval'));
          }
                 
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('djepoLocationBundle:evaluation')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find evaluation entity.');
        }

        $editForm = $this->createForm(new evaluationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('djepoLocationBundle:evaluation:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing evaluation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('djepoLocationBundle:evaluation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find evaluation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new evaluationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('eval_edit', array('id' => $id)));
        }

        return $this->render('djepoLocationBundle:evaluation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a evaluation entity.
     *  a gere avec SECURE
     */
    public function deleteAction(Request $request, $id)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
    	if (!is_object($user)) {
    		throw new AccessDeniedException('Vous n\'êtes pas authentifié.');
    	}
          if (! $this->get('security.context')->isGranted('ROLE_ADMIN')) {              
            $this->get('session')->getFlashBag()->add('warning', 'editEvaluation.flash.warning');
            return $this->redirect($this->generateUrl('eval'));
          }
        
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('djepoLocationBundle:evaluation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find evaluation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('eval'));
    }

    /**
     * Creates a form to delete a evaluation entity by id.
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
