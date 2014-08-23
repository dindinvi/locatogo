<?php

namespace djepo\UserBundle\Form\Type;
use Symfony\Component\Form\FormBuilderInterface; 
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserLocType extends UserType
{
     
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder 
           ->remove('plainPassword')
           ->remove('email')
            ->remove('personne')
            ->remove('captcha', 'captcha')
            
        ;
    }
     public function getName()
    {
        return 'djepo_userbundle_UserLocType';
    }

}


