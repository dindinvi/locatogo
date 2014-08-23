<?php

namespace djepo\UserBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdresseNewType extends AdresseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       parent::buildForm($builder, $options);
        $builder 
            ->remove('ville')
             ->add('ville', new VilleType)
            
              ;
         
    }
 

    public function getName()
    {
        return 'djepo_userbundle_adressenewtype';
    }
}
