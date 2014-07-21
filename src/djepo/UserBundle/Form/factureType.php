<?php

namespace djepo\UserBundle\Form;

use djepo\UserBundle\Form\Type\UserType;
use djepo\UserBundle\Form\Type\typePrestationType;
use djepo\LocationBundle\Form\locationType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class factureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre','text', array( 'required' => true,'label' => 'Titre '))
            ->add('dateEmission', 'date')
            ->add('typePrestation', new typePrestationType, array(
                            'empty_value' => 'Choisir...',
                            'required'  => true,
                          'label' => 'type de prestation',
                        ))
            ->add('user','entity', array(
                                        'class' => 'djepoUserBundle:User',
                                        'property' => 'username',
                                        'query_builder' => function(EntityRepository $er) {
                                            return null;
                                        }, ))
            ->add('reglement','entity', array(
                                        'class' => 'djepoUserBundle:reglement',
                                         'property' => 'id',
                                        'query_builder' => function(reglementRepository $re) {
                                            return null;
                                        }, ))
            ->add('location' ,'entity', array(
                                        'class' => 'djepoLocationBundle:location',
                                        'property' => 'id',
                                        'multiple' => false,
                                        'query_builder' => function(\djepo\LocationBundle\Entity\locationRepository $er) {
                                            return null;
                                        },  ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\UserBundle\Entity\facture'
        ));
    }

    public function getName()
    {
        return 'djepo_userbundle_facturetype';
    }
}
