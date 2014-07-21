<?php

namespace djepo\UserBundle\Form;
use  djepo\UserBundle\Form\Type\GenreType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('firstname','text', array( 'required' => true,'label' => 'Prenom '))
            ->add('lastname','text', array( 'required' => true,'label' => 'Nom'))
           ->add('typeEntite', new GenreType(), array(
                            'empty_value' => 'Choisir...',
                            'required'  => true,
                          'label' => 'Civilite/enité',
                        ))
		  
                ->add('telFixe','text', array( 'required' => false,'label' => 'Tel. Fixe '))
                ->add('telPortable','text', array('required' => false, 'label' => 'Tel. Portable '))
                ->add('fax','text', array( 'required' => false,'label' => 'Fax '))		
                ->add('adresse', new AdresseType)
            
              ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\UserBundle\Entity\Personne'
        ));
    }

    public function getName()
    {
        return 'djepo_userbundle_personnetype';
    }
}
