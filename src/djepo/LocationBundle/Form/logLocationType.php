<?php

namespace djepo\LocationBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class logLocationType extends logementType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       parent::buildForm($builder, $options);
       $builder
            ->remove('propriete')
            ->remove('montantloyer')   
            ->remove('nombrePiece')
            ->remove('surface' )
            ->remove('sejour' )
            ->remove('sbb' )
            ->remove('chambre' )
            ->remove('cuisine' )
           ->remove('image')
            ->remove('typeImmeuble');
               
    }

    
    public function getName()
    {
        return 'djepo_locationbundle_logLocationtype';
    }
}
