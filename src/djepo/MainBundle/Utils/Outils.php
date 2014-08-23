<?php

namespace djepo\MainBundle\Utils;
use Symfony\Component\HttpFoundation\Request;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Outils
 *
 * @author HOME
 */
class Outils extends \Twig_Extension {
      
     /**
     *
     * @var \Twig_Environment
     */
     protected $environment;
     protected $session; 
       protected $request;
       
        public function __construct($session )
        {
            $this->session = $session;  
            
        }
        
        public function initRuntime(\Twig_Environment $environment)
        {
            $this->environment = $environment;
        }
        /*
        * Twig va exécuter cette méthode pour savoir quelle(s) fonction(s)ajoute notre service
        */
        public function getFunctions() {
            return array(
                    'urlFormat' => new \Twig_Function_Method($this, 'url_format'),
                    'comparateurString' => new \Twig_Function_Method($this, 'ComparateurString'),
                    'mailExpression' => new \Twig_Function_Method($this, 'mailExpression'),
                    'getControllerName' => new \Twig_Function_Method($this, 'getControllerName'),
                     'getActionName' => new \Twig_Function_Method($this, 'getActionName'),
                     );
        }
        /*
        * La méthode getName() identifie votre extension Twig, elle est obligatoire
        */
        public function getName()
        {
        return 'Outils';
        }
         /**
        * Get controller name
        */
        public function getControllerName()
        {
            $regexp = "#Controller\\\([a-zA-Z]*)Controller#";
            $results = array();
            preg_match($regexp, $this->request->get('_controller'), $results);
           return strtolower($results[1]);
        }
        /**
         * Get action name
         */
         public function getActionName()
         {
            $regexp = "#::([a-zA-Z]*)Action#";
            $results = array();
            preg_match($regexp, $this->request->get('_controller'), $results);
           return $results[1];
         }
         
        function mailExpression($mail, $annonce,$proprio){
        
            $pos = strpos($mail, '@') ;
            if($pos === FALSE) {
                     return $this->container->getParameter(outils_admin);
            } else {
                        
                      $this->session->set('extensionMail',$mail); 
                      $this->session->set('annonceMail', $annonce);
                      
                      return $proprio;
            }
                        
    }
    
       function compareDate($dateDebut,$dateFin)
         {
		$DBEBUT = explode("/", $dateDebut);
		$DFIN = explode("/", $dateFin);
			
		$dD = $DBEBUT[2].$DBEBUT[1].$DBEBUT[0];
		$dF = $DFIN[2].$DFIN[1].$DFIN[0];
			
		if($dD > $dF) 
                    return 'date de début superieur à la date de fin';
		else 
                    return 'ok';
		 
		 }
                 
       function url_format($string)
	{
	    $string = str_replace(' ', '-', strtolower($string));
	    return  preg_replace('#[^a-z0-9-]#', '', $string);
	}
                
        function changeDateUsEnFr($date)
        {

           $dateus =  str_replace('-', '/', $date);
                $datefr=$dateus{8}.$dateus{9}."-".$dateus{5}.$dateus{6}."-".$dateus{0}.$dateus{1}.$dateus{2}.$dateus{3};
                return $datefr;
        }

        function changeDateFrEnUs($date)// pour insertion mysql
        {
           $datefr = str_replace('/', '-', $date);
           $dateus=$datefr{6}.$datefr{7}.$datefr{8}.$datefr{9}."-".$datefr{3}.$datefr{4}."-".$datefr{0}.$datefr{1};
           return $dateus;
        } 

        function generateurMdp()
	{
		// générer un mot de passe  Ensemble des caractères utilisés pour le créer
		$cars="AIBaz0eUrJtQy2uViCDE3oPpK4qs_5LdEZf6gMhR7NjFk8lm9GwSxOcvHbnT-WXY";
		$wlong=strlen($cars);
		$wpas="";
		$taille=rand(4,10);
		// On initialise la fonction aléatoire
		srand((double)microtime()*1000000);
		for($i=0;$i<$taille;$i++){ // Tirage aléatoire d'une valeur entre 1 et wlong
		    $wpos=rand(0,$wlong-1);
		    $wpas=$wpas.substr($cars,$wpos,1);
		     
		}
		
		return  $wpas;
  }

			
function  ComparateurString($str){//forceFilename

   $spaceChar = '-';
   $str = str_replace('Ã ','a',$str) ;
   $str = str_replace('Ã¢','a',$str) ;
   $str = str_replace('Ã©','e',$str) ;
   $str = str_replace('Ã¨','e',$str) ;
   $str = str_replace('Ã»','u',$str) ;
   $str = str_replace('Ã´','o',$str) ;
   $str = str_replace('Ã®','i',$str) ;
   $str = str_replace(' ','-',$str) ;
   $str = html_entity_decode($str, ENT_QUOTES, "utf-8");

	$str=trim($str);
	$_str = '';
	$i_max = strlen($str);
	for ($i=0; $i<$i_max; $i++)	{
	     
		$ch = $str[$i];
		switch ($ch){
			 			
			case 'Ã ':case 'Ã¢': case 'Ã£':case 'Ã¤': $_str = $_str.'a'; break;
			case 'Ã€':case 'Ã�':case 'Ãƒ': case 'Ã„':  case 'Ã…': $_str = $_str.'A'; break; 
			case 'Ã§': $_str = $_str.'c'; break;
			case 'Ã¨': case 'Ã©': case 'Ãª':case 'Ã«': case 'ÃƒÂ©':  $_str = $_str.'e'; break;
			 
			case 'Ãˆ': case 'Ã‰':  case 'ÃŠ': case 'Ã‹': $_str = $_str.'E'; break; 
			case 'ÃŒ': case 'Ã�':	case 'ÃŽ': case 'Ã�': $_str = $_str.'I'; break;   
			
                        case 'Ã¬': case 'Ã­':  case 'Ã®':  case 'Ã¯': $_str = $_str.'i'; break; 
			  
			case 'Ã‘':  $_str = $_str.'N'; break;
			 
                        case 'Ã²':  case 'Ã³': case 'Ã´':  case 'Ãµ':  case 'Ã¶': $_str = $_str.'o'; break;  
			
                        case 'Ã’':  case 'Ã“':  case 'Ã”':  case 'Ã•':  case 'Ã–': $_str = $_str.'O'; break; 
			 
                        case 'ÃŒ':  case 'Ã�': case 'ÃŽ': case 'Ã�': $_str = $_str.'I'; break; 
			 
			case 'Ã™': case 'Ãš':  case 'Ã›': case 'Ãœ': $_str = $_str.'U'; break; 
			  
			case 'Ã¹': case 'Ãº':  case 'Ã»': case 'Ã¼': case 'Å©':  case 'ÃƒÂ» ': $_str = $_str.'u'; break; 
                        
			case 'Ã¿': case'Ã½': $_str = $_str.'y'; break;
			 
			case 'Ã�': $_str = $_str.'D'; break;
			
			case '\'':  case ':': case ',': $_str = $_str.'-'; break;
			
                        case '/': case '(': case ')': $_str = $_str.'-'; break;
						
					
			default : $_str  = $_str. $ch; 
		}
	
	}      
	$_str = str_replace("{$spaceChar}{$spaceChar}", "{$spaceChar}", $_str);
	$_str = str_replace("{$spaceChar}-", '-', $_str);
	$_str = str_replace("-{$spaceChar}", '-', $_str);
	
 	return strtolower(trim($_str));
}

}

?>
