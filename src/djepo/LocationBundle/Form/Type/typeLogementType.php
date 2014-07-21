<?php

namespace djepo\LocationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class typeLogementType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'Pe' => 'logement entier', 
                'Cp' => 'Chambre Privée',
                'Ca' => 'Chambre Partagée',
                
            )
        ));
        
        
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'loca_typelogementT';
    }
}