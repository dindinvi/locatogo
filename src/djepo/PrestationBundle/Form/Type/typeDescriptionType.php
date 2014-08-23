<?php

namespace djepo\PrestationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class typeDescriptionType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'Chauffeur' => 'Chauffeur', 
                'Cuisinier' => 'Cuisinier',
                'Valet' => 'Valet', 
                'Nounou' => 'Nounou',
                
            )
        ));
        
        
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'loca_typeDescription';
    }
}