<?php

namespace djepo\MainBundle\Utils;
use Symfony\Component\Form\Form;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormErrorHelper
 *
 * @author guy
 */
class FormErrorHelper {
    
   public function getFormErrors($form)
    {
        $errors = array();

        if ($form instanceof Form) {
            foreach ($form->getErrors() as $error) {
                $errors[] = $error->getMessage();
            }
 
        }

        return $errors;
    }
    
    private function getErrorMessages(\Symfony\Component\Form\Form $form) {      
            $errors = array();

            if ($form->hasChildren()) {
                foreach ($form->getChildren() as $child) {
                    if (!$child->isValid()) {
                        $errors[$child->getName()] = $this->getErrorMessages($child);
                    }
                }
            } else {
                foreach ($form->getErrors() as $key => $error) {
                    $errors[] = $error->getMessage();
                }   
            }

            return $errors;
    }
    
    public function getErrorMessagesAsString(\Symfony\Component\Form\Form $form) {
       return  var_export($this->getErrorMessages($form), true);
    }
}
