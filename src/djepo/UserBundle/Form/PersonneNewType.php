<?php

namespace djepo\UserBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonneNewType extends PersonneType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       parent::buildForm($builder, $options);
        $builder 
            ->remove('adresse')
             ->add('adresse', new AdresseNewType)
            
              ;
    }


    public function getName()
    {
        return 'djepo_userbundle_personnenewtype';
    }
}
