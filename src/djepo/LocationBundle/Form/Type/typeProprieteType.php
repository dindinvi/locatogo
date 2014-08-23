<?php

namespace djepo\LocationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class typeProprieteType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'Appartement' => 'Appartement', 
                'Maison' => 'Maison',
                'Villa' => 'Villa',
                'Chambre d\' hôtes' => 'Chambre d\' hôtes',
                
            )
        ));
        
        
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'loca_typePropriete';
    }
}