<?php

namespace djepo\LocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class etatDesLieuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateVisite','date')
            ->add('avisLocataire','text', array('required' => false, 'label' => 'Avis locataire'))
             ->add('location' ,'entity', array(
                                        'class' => 'djepoLocationBundle:location',
                                        'property' => 'libelle',
                                        'multiple' => false,
                                        'query_builder' => function(\djepo\LocationBundle\Entity\locationRepository $er) {
                                            return null;
                                        },  ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\LocationBundle\Entity\etatDesLieux'
        ));
    }

    public function getName()
    {
        return 'djepo_locationbundle_etatdeslieuxtype';
    }
}
