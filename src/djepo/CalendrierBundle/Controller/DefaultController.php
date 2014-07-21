<?php

namespace djepo\CalendrierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
   
    public function indexAction($year)
    {
         $days = array('Lundi', 'Mardi' , 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
         $months = array('Janvier', 'Fevrier' , 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet'
             , 'Aout', 'Septembre', 'Octobe', 'Novembre', 'Decembre');
         
         $my_year = date('Y');
         $date =  $this->get('djepo_calendrier.dateTools');
         $dates = current($date->getAll($my_year)) ;
        
        return $this->render('djepoCalendrierBundle:Default:index.html.twig', 
                array('year' => $year,
                    'months' => $months,
                      'days' => $days,
                     'dates' => $dates
                    ));
    }
}
