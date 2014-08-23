<?php

namespace djepo\LocationBundle\Form;
 

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class proprieteNewType extends  proprieteType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm( $builder,$options);
        $builder
            ->remove('proprietaire')    
            ->add('proprietaire', new proprietaireNewType())
           
        ;
    }

   
    public function getName()
    {
        return 'djepo_locationbundle_newproprietetype';
    }
}
