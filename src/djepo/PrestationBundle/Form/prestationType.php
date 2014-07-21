<?php

namespace djepo\PrestationBundle\Form;
use djepo\PrestationBundle\Form\Type\typeDescriptionType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class prestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //prevoir une insertion multiple
        $builder
            ->add('typePrestation', new typeDescriptionType(), array(
                            'empty_value' => 'Choisir...',
                            'required'  => true,
                          'label' => 'Prestation',
                        ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\PrestationBundle\Entity\prestation'
        ));
    }

    public function getName()
    {
        return 'djepo_Prestationbundle_prestationtype';
    }
}
