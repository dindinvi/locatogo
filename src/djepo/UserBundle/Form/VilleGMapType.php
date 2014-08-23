<?php

namespace djepo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VilleGMapType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                
          ->add('nomVille','text', array('required' => true, 'label' => 'Ville'))
         // ->add('codeDepartement','integer', array('required' => false, 'label' => 'code Departement'))
         ->add('libelle','country', array('required' =>true, 'label' => 'Pays'))
         ->add('lat','hidden', array('required' => false))
         ->add('lng','hidden', array('required' => false ))
            ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\UserBundle\Entity\Ville'
        ));
    }

        
    
     public function getDefaultOptions(array $options)
    {
        return array(
            'virtual'   => true, // Ici nous précisons que notre FormType est un champ virtuel
        );
    }
 
    public function getName()
    {
        return 'gmap_address'; // Le nom de notre champ, il sera utilisé après
    }
}
