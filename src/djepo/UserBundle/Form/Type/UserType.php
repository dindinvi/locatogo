<?php

namespace djepo\UserBundle\Form\Type;

use djepo\UserBundle\Form\PersonneType;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class UserType extends BaseType
{
     
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array(
                'label' => 'form.username',
                'translation_domain' => 'FOSUserBundle'
                ))
             ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
           ->add('email', 'repeated', array(// add venant de RegistrationFormType
				'type' => 'text',
				'invalid_message' => 'Email different .',))
          ->add('personne', new PersonneType)
           ->add('captcha', 'captcha')
            
        ;
    }

}
