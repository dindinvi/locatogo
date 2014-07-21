<?php

namespace djepo\CalendrierBundle\EventListener;
 
use Doctrine\ORM\EntityManager;
use djepo\CalendrierBundle\Events\CalendrierEvents;
use djepo\CalendrierBundle\Entity\EventEntity;
//use djepo\LocationBundle\Entity\location;
class CalendrierEventListener
{
    private $entityManager;
    private $session;
    private $outils;
    
    public function __construct(EntityManager $entityManager, $session, $outils)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->outils = $outils;
    }
     /*   function chargerEntity($eventEntity, CalendrierEvents $calendarEvent){
            
                     $eventEntity->setAllDay(true); // default is false, set to true if this is an all day event
                     $eventEntity->setBgColor('#FF0000'); //set the background color of the event's label
                     $eventEntity->setFgColor('#FFFFFF'); //set the foreground color of the event's label 
                     $eventEntity->setCssClass('my-custom-class'); // a custom class you may want to apply to event labels

                     //finally, add the event to the CalendarEvent for displaying on the calendar
                     $calendarEvent->addEvent($eventEntity);
        }
    */    
    public function loadCalendrierEvents(CalendrierEvents $calendarEvent )
    {
        $startDate = $calendarEvent->getStartDatetime();
        $logementId = $this->session->get('encour_id');

         
       $cq = $this->entityManager->getRepository('djepoLocationBundle:location')
                          ->createQueryBuilder('l')
                          ->where('l.logement = :logement')->setParameter('logement', $logementId)
                          ->andWhere('l.valide = :valide')->setParameter('valide', '1') 
                          ->andWhere('l.dateLocation < :startDate')->setParameter('startDate', $startDate->format('Y-m-d H:i:s'));
       
              $cEvents = $cq->getQuery()->getResult();
       
        //->calandar($startDate, $logementId );
       //$r = array();->find(1);
              
              foreach($cEvents as $caEvent) {
                     $eventEntity = new EventEntity($caEvent->getDateLocation(), $caEvent->getDateFinLocation());
                     $eventEntity->setAllDay(true); // default is false, set to true if this is an all day event
                     $eventEntity->setBgColor('#FF0000'); //set the background color of the event's label
                     $eventEntity->setFgColor('#FFFFFF'); //set the foreground color of the event's label 
                     $eventEntity->setCssClass('my-custom-class'); // a custom class you may want to apply to event labels

                     //finally, add the event to the CalendarEvent for displaying on the calendar
                     $calendarEvent->addEvent($eventEntity);
                  }
    /*
       if(count($cEvents)>0 ){
           
            if( count($cEvents)<2  ){ 
                          $eventEntity = new EventEntity($cEvents->getDateLocation(), $cEvents->getDateFinLocation());
                          $eventEntity->setAllDay(true); // default is false, set to true if this is an all day event
                     $eventEntity->setBgColor('#FF0000'); //set the background color of the event's label
                     $eventEntity->setFgColor('#FFFFFF'); //set the foreground color of the event's label 
                     $eventEntity->setCssClass('my-custom-class'); // a custom class you may want to apply to event labels

                     //finally, add the event to the CalendarEvent for displaying on the calendar
                     $calendarEvent->addEvent($eventEntity);
            }else{
                   foreach($cEvents as $caEvent) {
                     $eventEntity = new EventEntity($caEvent->getDateLocation(), $caEvent->getDateFinLocation());
                     $eventEntity->setAllDay(true); // default is false, set to true if this is an all day event
                     $eventEntity->setBgColor('#FF0000'); //set the background color of the event's label
                     $eventEntity->setFgColor('#FFFFFF'); //set the foreground color of the event's label 
                     $eventEntity->setCssClass('my-custom-class'); // a custom class you may want to apply to event labels

                     //finally, add the event to the CalendarEvent for displaying on the calendar
                     $calendarEvent->addEvent($eventEntity);
                  }

            }   
    } */
  }
}