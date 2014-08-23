<?php

namespace djepo\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class searchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('dateLocation','date', array(  'input'  => 'datetime', 'widget' => 'choice', 'label' => 'Arrivée' , 'required' => false)) 
                ->add('dateFinLocation','date', array('label' => 'Départ' , 'required' => false) )
                ->add('nomVille','text', array('required' => false, 'label' => 'Ville'))
                ->add('montantLoyer','text', array( 'max_length' => 7, 'label' => 'Budget' , 'required' => false) )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array( 'data_class' => 'djepo\MainBundle\Entity\search'  ));
    }

    public function getName()
    {
        return 'djepo_mainbundle_searchtype';
    }
}
