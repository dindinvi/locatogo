<?php

namespace djepo\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class formContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject','text', array( 'required' => true,'label' => 'Titre'))
            ->add('nom','text', array( 'required' => true,'label' => 'Nom'))
            ->add('prenom','text', array('required' => false,'label' => 'Prenom'))
            ->add('email', 'email', array('trim' => true, 'required' => true,'label' => 'Email'))
            ->add('message','textarea', array('required' => true, 'attr' => array('rows' => '10','cols' => '30')) )
            //->add('captcha', 'captcha')
        ;
    }
  
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\MainBundle\Entity\formContact'
        ));
    }

    public function getName()
    {
        return 'djepo_mainbundle_formcontacttype';
    }
}
