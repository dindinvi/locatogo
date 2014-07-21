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
           ->remove('dateAnnonce')
           ->remove('transport')
           ->remove('dateFinAnnonce')
           ->remove('dateUpdateAnnonce')
           ->remove('nbEvaluations')
          // ->remove('evaluations')
           ->remove('propriete')
           ->add('propriete', new proprieteNewType)
               ;
    }

    
    public function getName()
    {
        return 'djepo_locationbundle_newlogementtype';
    }
}
