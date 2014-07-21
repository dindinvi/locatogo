<?php

namespace djepo\LocationBundle\Form;

use djepo\LocationBundle\Form\Type\typeProprietaireType;
use djepo\UserBundle\Form\PersonneType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class proprietaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeProprietaire', new typeProprietaireType(), array(
                            'empty_value' => 'Choisir...',
                            'required'  => true,
                          'label' => 'type de proprietaire',
                        ))
            
            ->add('token','hidden')
            ->add('personne', new PersonneType())
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\LocationBundle\Entity\proprietaire'
        ));
    }

    public function getName()
    {
        return 'djepo_locationbundle_proprietairetype';
    }
}
