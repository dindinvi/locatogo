<?php

namespace djepo\LocationBundle\Form;
use djepo\LocationBundle\Form\Type\typeEtatTypes;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class etatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle','text', array('required' => true, 'label' => 'transport '))
            ->add('etat', new typeEtatTypes(), array(
                            'empty_value' => 'Choisir...',
                            'required'  => true,
                          'label' => 'etat du bien: ',
                        ))
            ->add('etatDesLieux','entity', array(
                                        'class' => 'djepoLocationBundle:etatDesLieux',
                                        'property' => 'id',
                                        'multiple' => false,
                                        'query_builder' => function(\djepo\LocationBundle\Entity\etatDesLieuxRepository $er) {
                                            return null;
                                        },  ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\LocationBundle\Entity\etat'
        ));
    }

    public function getName()
    {
        return 'djepo_locationbundle_etattype';
    }
}
