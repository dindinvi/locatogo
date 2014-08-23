<?php

namespace djepo\LocationBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class logementNewType extends logementType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       parent::buildForm($builder, $options);
       $builder
           ->remove('propriete')
           ->add('propriete', new proprieteNewType)
               ;
    }

    
   
}
