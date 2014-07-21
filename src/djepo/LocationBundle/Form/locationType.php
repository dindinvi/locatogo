<?php

namespace djepo\LocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class locationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('logement','entity', array(
                                        'class' => 'djepoLocationBundle:logement',
                                        'property' => 'libelle',
                                        'multiple' => false,
                                        'query_builder' => function(\djepo\LocationBundle\Entity\logementRepository $er) {
                                            return null;
                                        },  )) 
                ->add('user','entity', array(
                                        'class' => 'djepoUserBundle:User',
                                        'property' => 'username',
                                        'query_builder' => function(EntityRepository $er) {
                                            return null;
                                        }, ))
           ->add('dateLocation','date')
           ->add('dateFinLocation','date')
           ->add('dateUpdateLocation','date') 
           ->add('token','hidden')
           ->add('valide','checkbox', array('required' => false))
           ->add('montantLoyer','text', array( 'max_length' => 2,  'required' => true) )
            ->add('typeLoyer','text', array('required' => false, 'label' => 'type loye')) 
            ->add('montantCharges','text', array( 'max_length' => 10,  'required' => true))
             ;
       
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\LocationBundle\Entity\location'
        ));
    }

    public function getName()
    {
        return 'djepo_locationbundle_locationtype';
    }
}
