<?php

namespace djepo\PrestationBundle\Form;

use djepo\LocationBundle\Form\locationType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

namespace djepo\LocationBundle\Form;

class locationPrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDepartPrestation','date')
            ->add('dateFinPrestation','date')
            ->add('montant','text', array( 'required' => true,'label' => 'Montant '))
            ->add('commentaire','text', array( 'required' => false,'label' => 'commentaire '))
            ->add('location' ,'entity', array(
                                        'class' => 'djepoLocationBundle:location',
                                        'property' => 'id',
                                        'multiple' => false,
                                        'query_builder' => function(\djepo\LocationBundle\Entity\locationRepository $er) {
                                            return null;
                                        },  ))
        
            ->add('prestation','entity', array(
                                        'class' => 'djepoPrestationBundle:prestation',
                                        'property' => 'description',
                                        'multiple' => false,
                                        'query_builder' => function(\djepo\PrestationBundle\Entity\prestationRepository $er) {
                                            return null;
                                        },  ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\PrestationBundle\Entity\locationPrestation'
        ));
    }

    public function getName()
    {
        return 'djepo_Prestationbundle_locationprestationtype';
    }
}
