<?php

namespace djepo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroVoie','text', array( 'max_length' => 5, 'label' => 'numero Voie', 'required' => false, 'read_only' => false))
            ->add('libelleAdd','text', array('required' => false,'label' => 'lib. Addresse ', 'read_only' => false))
            ->add('codePostal','text', array('max_length' => 5,'required' => false,'max_length' => 5,'label' => 'code Postal', 'required' => false, 'read_only' => false))
            ->add('ville', new VilleType) 
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\UserBundle\Entity\Adresse'
        ));
    }

    public function getName()
    {
        return 'djepo_userbundle_adressetype';
    }
}
