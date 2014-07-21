<?php

namespace djepo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('nomVille','text', array('required' => false, 'label' => 'Ville'))
            //->add('codeDepartement','integer', array('required' => false, 'label' => 'code Departement'))
            ->add('libelle','country', array('required' => false, 'label' => 'Pays'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\UserBundle\Entity\Ville'
        ));
    }

    public function getName()
    {
        return 'djepo_userbundle_villetype';
    }
}
