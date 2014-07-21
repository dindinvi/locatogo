<?php

namespace djepo\CalendrierBundle\Utils;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Outils
 *
 * @author HOME
 */
class DateTools extends \Twig_Extension {
    //put your code here
         protected $session; 
        public function __construct($session)
        {
            $this->session = $session; 
        }
        /*
        * Twig va exécuter cette méthode pour savoir quelle(s) fonction(s)ajoute notre service
        */
        public function getFunctions() {
            return array(
                    'truncable' => new \Twig_Function_Method($this, 'truncable') ,
                    'calDecalage' => new \Twig_Function_Method($this, 'calDecalage'),
                'calLastValTable' => new \Twig_Function_Method($this, 'calLastValTable'),
                'myStrToTime' => new \Twig_Function_Method($this, 'myStrToTime'),
                 'myStrToTime2' => new \Twig_Function_Method($this, 'myStrToTime2'),   
                );
        }
        /*
        * La méthode getName() identifie votre extension Twig, elle est obligatoire
        */
        public function getName()
        {
        return 'DateTools';
        }
         
 
                 /*
                  * obtenir tous les jours de l année
                  */
                 function getAll($year){
                     $r = array();
                     $date = new \DateTime($year.'-01-01');
                      while($date->format('Y') <= $year){
                                $y = $date->format('Y');
                                $m = $date->format('n');
                                $d =  $date->format('j');
                                $w = str_replace('0','7',$date->format('w'));
                                //$w =  $date->format('w');
                                $r[$y][$m][$d]=$w;
                         $date->add(new \DateInterval('P1D'));
                                
                     }
                    
                     return $r;
                 }
                 
                 public function truncable($val, $nbre){
                     return utf8_encode(substr(utf8_decode($val),0,$nbre));
                 }
                 
                 public function calDecalage($val){
                     return utf8_encode(substr(utf8_decode($val),0,3));
                 }
                 
                  public function calLastValTable($val){
                     $end = end($val);
                     return $end ;
                 }
                 
               function  myStrToTime($year, $m, $d){
                     //return strtotime("$year-$m-$d") ;
                      $date = new \DateTime("$year-$m-$d");
                     return $date; 
                 }
                 
                 function  myStrToTime2($d){
                     return strtotime((string)$d) ;
                 }
}

?>
