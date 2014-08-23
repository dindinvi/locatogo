<?php

namespace djepo\LocationBundle\Form;
use djepo\UserBundle\Form\PersonneNewType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class proprietaireNewType extends proprietaireType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm( $builder, $options);
        $builder
                ->remove('typeProprietaire') 
                //->remove('token') 
                ->remove('personne')
                ->add('personne', new PersonneNewType())
               /* ->add('personne','entity', array(
                                        'class' => 'djepoUserBundle:Personne',
                                        'property' => 'lastname',
                                        'query_builder' => function(EntityRepository $er) {
                                            return null;
                                        }, ))
                * 
                */
                ;
    }

    
    public function getName()
    {
        return 'djepo_locationbundle_newproprietairetype';
    }
}
