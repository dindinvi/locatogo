<?php

namespace djepo\LocationBundle\Utils;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Outils
 *
 * @author HOME
 */
class LocationTools extends \Twig_Extension {
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
                    'compareDateForLocationPrestation' => new \Twig_Function_Method($this, 'compareDateForLocationPrestation')  
            );
        }
        /*
        * La méthode getName() identifie votre extension Twig, elle est obligatoire
        */
        public function getName()
        {
        return 'LocationTools';
        }
         
function compareDateForLocationPrestation($dateDebut,$dateFin)
         {
		    $DBEBUT = explode("/", $dateDebut);
			$DFIN = explode("/", $dateFin);
			$somme = 0;
			
			$dD = $DBEBUT[2].$DBEBUT[1].$DBEBUT[0];
			$dF = $DFIN[2].$DFIN[1].$DFIN[0];
			

			if($dD > $dF)
			{
			  $message = '<span class="erreur">date de début superieur à la date de fin.</span><br>';
			  $contenu='';
			   $somme = 1;
			}
			else {
			        $message='';
					$contenu = 'ok';
					
			}
			
			$information=array($message,$contenu,$somme);
			return $information;
		 
		 }
}
?>
