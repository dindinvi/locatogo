<?php

namespace djepo\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MotsCleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre','text')
            ->add('description','textarea')
            ->add('robot','text')
            ->add('keyword','textarea')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\MainBundle\Entity\MotsCle'
        ));
    }

    public function getName()
    {
        return 'djepo_mainbundle_motscletype';
    }
}
