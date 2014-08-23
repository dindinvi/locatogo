<?php

namespace djepo\LocationBundle\Form;
use \djepo\UserBundle\Form\AdresseType;

use djepo\LocationBundle\Form\Type\typeProprieteType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class proprieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proprietaire', new proprietaireType())
            ->add('typepropriete', new typeProprieteType(), array(
                            'empty_value' => 'Choisir...',
                            'required'  => true,
                          'label' => 'type de proprieté',
                        ))
            ->add('adresse', new AdresseType())
            ->add('description','textarea', array('required' => true,'label' => 'description: ', 'attr' => array('rows' => '10','cols' => '30')) )
            //->add('nomPropriete','text', array( 'required' => false,'label' => 'Titre: '))
           
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\LocationBundle\Entity\propriete'
        ));
    }

    public function getName()
    {
        return 'djepo_locationbundle_proprietetype';
    }
}
