<?php

namespace djepo\LocationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class typeProprietaireType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'Pu' => 'Public', 
                'pr' => 'Prive',
                
            )
        ));
        
        
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'loca_typeProprietaire';
    }
}