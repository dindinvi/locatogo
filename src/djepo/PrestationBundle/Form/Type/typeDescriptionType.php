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
                'Ch' => 'Chauffeur', 
                'Cu' => 'Cuisinier',
                'V' => 'Valet', 
                'N' => 'Nounou',
                
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