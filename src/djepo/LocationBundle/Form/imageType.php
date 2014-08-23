<?php

namespace djepo\LocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class imageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url','text', array('required' =>false, 'label' => 'Titre Photo '))
            ->add('alt','text', array('required' => false, 'label' => 'Description '))
            ->add('file1', 'file', array('required' => false)) 
            ->add('url2','text', array('required' => false, 'label' => 'Titre Photo 2 '))
            ->add('alt2','text', array('required' => false, 'label' => 'Description '))    
           ->add('file2', 'file', array('required' => false)) 
            ->add('url3','text', array('required' => false, 'label' => 'Titre Photo 3 '))
            ->add('alt3','text', array('required' => false, 'label' => 'Description ')) 
           ->add('file3', 'file', array('required' => false))      
            
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\LocationBundle\Entity\image'
        ));
    }

    public function getName()
    {
        return 'djepo_locationbundle_imagetype';
    }
}
