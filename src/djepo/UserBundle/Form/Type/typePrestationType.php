<?php

namespace djepo\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class typePrestationType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'LV' => 'Location vacance', 
                'LD' => 'Location long durée',
                'LP' => 'location permanant',
            )
        ));
        
        
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'typePrestationT';
    }
}