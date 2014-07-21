<?php

namespace djepo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('newMail', 'repeated', array(
        		'type' => 'text',
         		 'invalid_message' => 'Email different .',))
        
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\UserBundle\Entity\Admin'
        ));
    }

    public function getName()
    {
        return 'djepo_userbundle_admintype';
    }
}
