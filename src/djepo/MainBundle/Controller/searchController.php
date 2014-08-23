<?php

namespace djepo\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use djepo\MainBundle\Entity\search;
use djepo\MainBundle\Form\searchType;

/**
 * search controller.
 *
 */
class searchController extends Controller
{
    

    /**
     * Creates a new search entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new search();
        $form = $this->createForm(new searchType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            
            $dateD = $entity->getDateLocation();
            $dateF = $entity->getDateFinLocation();
            $Ville = $entity->getNomVille();
            $Budget = $entity->getMontantLoyer();
            
            $this->get('session')->set('search_dateD',$dateD);
            $this->get('session')->set('search_dateF',$dateF);
            $this->get('session')->set('search_ville',$Ville);
            $this->get('session')->set('search_budget',$Budget);
            $page = 1;
            $em = $this->getDoctrine()->getManager();
            $maxParPage = 10; 
            if ( $dateF && $dateD ){
               $entities = $em->getRepository('djepoLocationBundle:location')
                     ->getSearchLocation( 1,
                         $maxParPage,
                         $dateD,
                         $dateF,
                         $Ville,
                         $Budget
                 );// GESTION DE LA PANGINATION 
            }else {
                    $entities = $em->getRepository('djepoLocationBundle:logement')
                     ->getSearchLocation( 1,
                         $maxParPage,
                         $dateD,
                         $dateF,
                         $Ville,
                         $Budget
                 );// GESTION DE LA PANGINATION
             }
                $total_jobs = count($entities);
                $last_page = ceil($total_jobs / $maxParPage);//$jobs_per_page);
                 $previous_page = $page > 1 ? $page - 1 : 1;
                $next_page = $page < $last_page ? $page + 1 : $last_page;

               return $this->render('djepoLocationBundle:logement:logementSearch.html.twig', array(
                    'entities' => $entities ,
                    'last_page' => $last_page,
                    'previous_page' => $previous_page,
                    'current_page' => $page,
                    'next_page' => $next_page,
                    'total_jobs' => $total_jobs
                ));
             
        }

        return $this->render('djepoMainBundle:search:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new search entity.
     *
     */
    public function newAction()
    {
        $entity = new search();
        $form   = $this->createForm(new searchType(), $entity);
                $this->get('session')->set('search_dateD',null);
                $this->get('session')->set('search_dateF',null);
                $this->get('session')->set('search_ville',null);
                $this->get('session')->set('search_budget',null);
        return $this->render('djepoMainBundle:search:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    
}
