<?php

namespace djepo\CalendrierBundle\Controller;

//use djepo\CalendrierBundle\Entity\rechercheParAnnee;
use djepo\CalendrierBundle\form\rechercheParAnneeType;
use djepo\CalendrierBundle\CalendrierListeEvents;
use djepo\CalendrierBundle\Events\CalendrierEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CalendrierController extends Controller
{
   
    public function calendrierAction()
    {
         $days = array('Lundi', 'Mardi' , 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
         $months = array('Janvier', 'Fevrier' , 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet'
             , 'Aout', 'Septembre', 'Octobe', 'Novembre', 'Decembre');
         
        
        $request = $this->container->get('request');

        if($request->isXmlHttpRequest()) {
            $motcle = '';
            $motcle = $request->request->get('annee');

           if($motcle != '') {
                      $my_year = $motcle->date('Y');// $motcle;  
            }
            else {
                      $my_year = date('Y');
            }
        }
        else{
            
                $my_year = date('Y');
        }
         $form = $this->container->get('form.factory')->create(new rechercheParAnneeType());  
           //$ent  = new rechercheParAnnee();
         // $form = $this->createForm(new rechercheParAnneeType(), $ent);
        
         $date =  $this->get('djepo_calendrier.dateTools');
         $dates = current($date->getAll($my_year)) ;
        
      // On crée l'évènement avec ses
         $st_date = new \DateTime($my_year.'-12-31');
         $now_date = new \DateTime();
         $event = new CalendrierEvents($st_date);
        // On déclenche l'évènement
           $events =  $this->get('event_dispatcher')->dispatch(CalendrierListeEvents ::onEventPost, $event)->getEvents();
        // On récupère ce qui a été modifié par le ou les listeners,ici le message
          $return_events = array();
        
        foreach($events as $e) {
            $return_events[] = $e->toArray();    
        }
        
        return $this->render('djepoCalendrierBundle:Calendrier:calendrier.html.twig', 
                array(
                        'form' => $form->createView(),
                        'year' => $my_year,
                        'months' => $months,
                        'days' => $days,
                        'dates' => $dates, 
                        'eventsP' => $events ,
                       'now_date' => $now_date 
                    //$return_events
                    ));
    }
    
 
}
