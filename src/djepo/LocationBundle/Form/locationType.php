<?php

namespace djepo\LocationBundle\Form;

use djepo\UserBundle\Form\Type\UserLocType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class locationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                 
                ->add('dateLocation','date')
                ->add('dateFinLocation','date')
                
                /*s->add('logement', new logLocationType())
                 *  ->add('user', new UserLocType() )
                 * ->add('montantLoyer','text', array( 'max_length' => 2, 'label' => 'montant Loyer' , 'required' => true) )
                ->add('typeLoyer','text', array('required' => false, 'label' => 'type loye')) 
                ->add('montantCharges','text', array( 'max_length' => 10,  'required' => true))*/
                
                     ;
       
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\LocationBundle\Entity\location'
           // 'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'djepo_locationbundle_locationtype';
    }
}
