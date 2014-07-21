<?php

namespace djepo\UserBundle\Form; 

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class reglementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                 ->add('user','entity', array(
                                        'class' => 'djepoUserBundle:User',
                                        'property' => 'username',
                                        'query_builder' => function(EntityRepository $er) {
                                            return null;
                                        }, ))
            ->add('facture','entity', array(
                                        'class' => 'djepoUserBundle:facture',
                                        'property' => 'id',
                                        'query_builder' => function(factureRepository $re) {
                                            return null;
                                        }, ))
            ->add('datePerception','date')
            ->add('montantPercu','text', array( 'max_length' => 7, 'label' => 'montant Percu', 'required' => true))
            ->add('dateVersement','date')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\UserBundle\Entity\reglement'
        ));
    }

    public function getName()
    {
        return 'djepo_Userbundle_reglementtype';
    }
}
